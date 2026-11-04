<?php

namespace App\Http\Controllers\Cbt\Examiner;

use App\Http\Controllers\Controller;
use App\Models\Examination;
use App\Models\ExaminationResult;
use App\Models\ExaminationScoreAudit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{
    /**
     * Confirm that the logged-in examiner is assigned to the examination.
     */
    private function ensureAssigned(
        Request $request,
        Examination $examination
    ): void {
        $isAssigned = $request->user()
            ->assignedExaminations()
            ->where('examinations.id', $examination->id)
            ->exists();

        abort_unless(
            $isAssigned,
            403,
            'You are not assigned to this examination.'
        );
    }

    /**
     * Restrict attempts to students whose class and department
     * are eligible for the examination.
     */
    private function applyEligibleStudents(
        $query,
        Examination $examination
    ) {
        $examination->loadMissing('schoolClass');

        $className = strtoupper(
            (string) ($examination->schoolClass?->name ?? '')
        );

        if (str_starts_with($className, 'SS')) {
            return $query->whereHas('student', function ($studentQuery) use ($examination) {
                $studentQuery->where(
                    'school_class_id',
                    $examination->school_class_id
                );

                if ($examination->department !== null) {
                    $studentQuery->where(
                        'department',
                        $examination->department
                    );
                }
            });
        }

        if (str_starts_with($className, 'JSS')) {
            abort_unless(
                $examination->department === null,
                403,
                'Junior secondary examinations cannot have a department.'
            );

            return $query->whereHas('student', function ($studentQuery) use ($examination) {
                $studentQuery
                    ->where(
                        'school_class_id',
                        $examination->school_class_id
                    )
                    ->whereNull('department');
            });
        }

        abort(403, 'This examination has an invalid class configuration.');
    }

    /**
     * Confirm that a result belongs to this examination
     * and that its student is eligible for the examination.
     */
    private function ensureResultBelongsToExamination(
        ExaminationResult $result,
        Examination $examination
    ): void {
        $attemptQuery = $result->attempt()
            ->where('examination_id', $examination->id)
            ->where('status', 'submitted')
            ->whereNotNull('submitted_at');

        $this->applyEligibleStudents(
            $attemptQuery,
            $examination
        );

        abort_unless(
            $attemptQuery->exists(),
            404,
            'The result does not belong to an eligible student in this examination.'
        );
    }

    /**
     * Verify that every score component and calculated result
     * is complete and correct before examiner review.
     */
    private function verifyResultForReview(
        ExaminationResult $result,
        Examination $examination
    ): void {
        $components = [
            'ca_marks' => (int) $examination->ca_total,
            'objective_marks' => (int) $examination->objective_total,
            'theory_marks' => (int) $examination->theory_total,
        ];

        $configuredTotal = array_sum($components);

        abort_unless(
            (int) $examination->total_marks === $configuredTotal
            && $configuredTotal > 0,
            422,
            'The examination scoring configuration is inconsistent.'
        );

        abort_unless(
            (int) $examination->pass_mark >= 0
            && (int) $examination->pass_mark <= $configuredTotal,
            422,
            'The examination pass mark is invalid.'
        );

        $calculatedMarks = 0;

        foreach ($components as $field => $maximum) {
            $marks = $result->{$field};

            // No score is required when the component maximum is zero.
            if ($maximum === 0) {
                abort_unless(
                    $marks === null || (
                        is_numeric($marks)
                        && (float) $marks === 0.0
                    ),
                    422,
                    'A score was recorded for a component that has no allocated marks.'
                );

                continue;
            }

            // Every component with allocated marks must be completed.
            abort_unless(
                $marks !== null && is_numeric($marks),
                422,
                'This result is incomplete. All required score components must be entered.'
            );

            $marks = (float) $marks;

            abort_unless(
                $marks >= 0
                && $marks <= $maximum
                && floor($marks) === $marks,
                422,
                'One or more score components contain invalid marks.'
            );

            $calculatedMarks += (int) $marks;
        }

        abort_unless(
            (int) $result->marks_obtained === $calculatedMarks,
            422,
            'The recorded total does not match the individual score components.'
        );

        abort_unless(
            (int) $result->total_marks === $configuredTotal,
            422,
            'The result total does not match the examination total.'
        );

        $expectedPercentage = round(
            ($calculatedMarks / $configuredTotal) * 100,
            2
        );

        abort_unless(
            $result->percentage !== null
            && round((float) $result->percentage, 2) === $expectedPercentage,
            422,
            'The recorded percentage is incorrect.'
        );

        $expectedOutcome = $calculatedMarks >= (int) $examination->pass_mark
            ? 'passed'
            : 'failed';

        abort_unless(
            $result->outcome === $expectedOutcome,
            422,
            'The recorded pass/fail outcome is incorrect.'
        );
    }

    /**
     * Display submitted student attempts.
     *
     * task=entry displays results awaiting score entry.
     * task=review displays results awaiting examiner review.
     * Without a task filter, all submitted eligible attempts are displayed.
     */
    public function index(Request $request, Examination $examination)
    {
        $this->ensureAssigned($request, $examination);

        $examination->loadMissing('schoolClass');

        $task = $request->query('task');

        if (!in_array($task, ['entry', 'review'], true)) {
            $task = null;
        }

        $attemptsQuery = $examination->attempts()
            ->with(['student', 'result'])
            ->whereNotNull('submitted_at');

        $this->applyEligibleStudents(
            $attemptsQuery,
            $examination
        );

        if ($task === 'entry') {
            $attemptsQuery->whereHas('result', function ($query) {
                $query->where('status', 'awaiting_scores');
            });
        }

        if ($task === 'review') {
            $attemptsQuery->whereHas('result', function ($query) {
                $query->where('status', 'pending_review');
            });
        }

        $attempts = $attemptsQuery
            ->latest('submitted_at')
            ->paginate(20)
            ->withQueryString();

        return view('cbt.examiner.scores.index', compact(
            'examination',
            'attempts',
            'task'
        ));
    }

    /**
     * Enter or update examination score components.
     */
    public function update(
        Request $request,
        Examination $examination,
        ExaminationResult $result
    ) {
        $this->ensureAssigned($request, $examination);

        $this->ensureResultBelongsToExamination(
            $result,
            $examination
        );

        abort_unless(
            $result->status === 'awaiting_scores',
            403,
            'This result is no longer open for score entry.'
        );

        $rules = [];

        if ((int) $examination->ca_total > 0) {
            $rules['ca_marks'] = [
                'sometimes',
                'required',
                'integer',
                'min:0',
                'max:' . (int) $examination->ca_total,
            ];
        }

        if ((int) $examination->theory_total > 0) {
            $rules['theory_marks'] = [
                'sometimes',
                'required',
                'integer',
                'min:0',
                'max:' . (int) $examination->theory_total,
            ];
        }

        if (
            $examination->mode === 'physical'
            && (int) $examination->objective_total > 0
        ) {
            $rules['objective_marks'] = [
                'sometimes',
                'required',
                'integer',
                'min:0',
                'max:' . (int) $examination->objective_total,
            ];
        }

        if (
            $examination->mode !== 'physical'
            && $request->has('objective_marks')
        ) {
            return back()->withErrors([
                'objective_marks' =>
                    'Online objective marks are calculated automatically by the CBT system.',
            ])->withInput();
        }

        if (
            !$request->has('ca_marks')
            && !$request->has('theory_marks')
            && !$request->has('objective_marks')
        ) {
            return back()->withErrors([
                'score' => 'Enter at least one score component.',
            ]);
        }

        $validated = $request->validate($rules);

        DB::transaction(function () use (
            $validated,
            $request,
            $examination,
            $result
        ) {
            $lockedResult = ExaminationResult::query()
                ->whereKey($result->id)
                ->lockForUpdate()
                ->firstOrFail();

            $this->ensureResultBelongsToExamination(
                $lockedResult,
                $examination
            );

            abort_unless(
                $lockedResult->status === 'awaiting_scores',
                403,
                'This result is no longer open for score entry.'
            );

            $components = [
                'ca_marks' => (int) $examination->ca_total,
                'objective_marks' => (int) $examination->objective_total,
                'theory_marks' => (int) $examination->theory_total,
            ];

            foreach ($validated as $field => $newMarks) {
                $oldMarks = $lockedResult->{$field};
                $newMarks = (int) $newMarks;

                if (
                    $oldMarks === null
                    || (int) $oldMarks !== $newMarks
                ) {
                    ExaminationScoreAudit::create([
                        'examination_result_id' => $lockedResult->id,
                        'entered_by' => $request->user()->id,
                        'component' => $field,
                        'old_marks' => $oldMarks,
                        'new_marks' => $newMarks,
                        'entered_at' => now(),
                    ]);

                    $lockedResult->{$field} = $newMarks;
                }
            }

            $allComponentsComplete = true;

            foreach ($components as $field => $maximum) {
                if ($maximum === 0) {
                    continue;
                }

                if ($lockedResult->{$field} === null) {
                    $allComponentsComplete = false;
                    break;
                }
            }

            if ($allComponentsComplete) {
                $finalMarks =
                    (int) $lockedResult->ca_marks
                    + (int) $lockedResult->objective_marks
                    + (int) $lockedResult->theory_marks;

                $totalMarks = (int) $examination->total_marks;

                $percentage = $totalMarks > 0
                    ? round(($finalMarks / $totalMarks) * 100, 2)
                    : 0;

                $lockedResult->marks_obtained = $finalMarks;
                $lockedResult->total_marks = $totalMarks;
                $lockedResult->percentage = $percentage;

                $lockedResult->outcome =
                    $finalMarks >= (int) $examination->pass_mark
                    ? 'passed'
                    : 'failed';

                $lockedResult->status = 'pending_review';
            } else {
                $lockedResult->marks_obtained = 0;
                $lockedResult->percentage = 0;
                $lockedResult->outcome = 'pending';
                $lockedResult->status = 'awaiting_scores';
            }

            $lockedResult->save();
        });

        return redirect()
            ->route(
                'cbt.examiner.examinations.scores.index',
                $examination
            )
            ->with(
                'success',
                'Student scores have been saved successfully.'
            );
    }

    /**
     * Display a completed result for examiner review.
     */
    public function show(
        Request $request,
        Examination $examination,
        ExaminationResult $result
    ) {
        $this->ensureAssigned($request, $examination);

        $this->ensureResultBelongsToExamination(
            $result,
            $examination
        );

        abort_unless(
            $result->status === 'pending_review',
            403,
            'This result is not currently awaiting examiner review.'
        );

        $result->load([
            'attempt.student',
            'scoreAudits.examiner',
        ]);

        return view('cbt.examiner.scores.review', compact(
            'examination',
            'result'
        ));
    }

    /**
     * Submit an examiner-reviewed result for administrator approval.
     */
    public function review(
        Request $request,
        Examination $examination,
        ExaminationResult $result
    ) {
        $this->ensureAssigned($request, $examination);

        $this->ensureResultBelongsToExamination(
            $result,
            $examination
        );

        $validated = $request->validate([
            'remarks' => ['nullable', 'string', 'max:5000'],
        ]);

        DB::transaction(function () use (
            $request,
            $examination,
            $result,
            $validated
        ) {
            $lockedResult = ExaminationResult::query()
                ->whereKey($result->id)
                ->lockForUpdate()
                ->firstOrFail();

            $this->ensureResultBelongsToExamination(
                $lockedResult,
                $examination
            );

            abort_unless(
                $lockedResult->status === 'pending_review',
                403,
                'This result is not currently awaiting examiner review.'
            );

            // Independently verify all scores and calculations.
            $this->verifyResultForReview(
                $lockedResult,
                $examination
            );

            $lockedResult->reviewed_by = $request->user()->id;
            $lockedResult->reviewed_at = now();
            $lockedResult->remarks = $validated['remarks'] ?? null;
            $lockedResult->status = 'pending_approval';

            $lockedResult->save();
        });

        return redirect()
            ->route(
                'cbt.examiner.examinations.scores.index',
                $examination
            )
            ->with(
                'success',
                'The result has been reviewed and submitted for administrator approval.'
            );
    }
}

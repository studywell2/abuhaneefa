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

        // Preserve class and department eligibility restrictions.
        $this->applyEligibleStudents(
            $attemptsQuery,
            $examination
        );

        // Show only results awaiting score entry.
        if ($task === 'entry') {
            $attemptsQuery->whereHas('result', function ($query) {
                $query->where('status', 'awaiting_scores');
            });
        }

        // Show only results awaiting examiner review.
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

            // Recheck eligibility inside the transaction.
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

            // Recheck eligibility inside the transaction.
            $this->ensureResultBelongsToExamination(
                $lockedResult,
                $examination
            );

            abort_unless(
                $lockedResult->status === 'pending_review',
                403,
                'This result is not currently awaiting examiner review.'
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

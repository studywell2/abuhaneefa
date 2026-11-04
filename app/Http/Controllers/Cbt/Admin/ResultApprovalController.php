<?php

namespace App\Http\Controllers\Cbt\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExaminationResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultApprovalController extends Controller
{
    public function index()
    {
        $results = ExaminationResult::with([
            'attempt.student.user',
            'attempt.examination.schoolClass',
            'examiner',
        ])
            ->where('status', 'pending_approval')
            ->latest()
            ->paginate(20);

        return view('cbt.admin.results.index', compact('results'));
    }

    public function show(ExaminationResult $result)
    {
        $result->load([
            'attempt.student.user',
            'attempt.examination.schoolClass',
            'examiner',
            'approver',
            'scoreAudits.examiner',
        ]);

        return view('cbt.admin.results.show', compact('result'));
    }

    private function verifyResultForApproval(ExaminationResult $result): void
    {
        $result->loadMissing(['attempt.examination']);

        $attempt = $result->attempt;
        $examination = $attempt?->examination;

        abort_unless(
            $attempt && $examination,
            422,
            'The examination attempt or examination record could not be found.'
        );

        abort_unless(
            $attempt->status === 'submitted'
            && $attempt->submitted_at !== null,
            422,
            'This examination attempt has not been properly submitted.'
        );

        abort_unless(
            $result->reviewed_by !== null
            && $result->reviewed_at !== null,
            422,
            'This result has not been reviewed by an examiner.'
        );

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
            'The examination scoring configuration is inconsistent. Please review it before approving results.'
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

            // A component with a maximum of zero requires no score.
            // Accept NULL or zero for that component.
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

            // Components with allocated marks must have a valid score.
            abort_unless(
                $marks !== null && is_numeric($marks),
                422,
                'The result is incomplete. One or more required score components are missing.'
            );

            $marks = (float) $marks;

            abort_unless(
                $marks >= 0
                && $marks <= $maximum
                && floor($marks) === $marks,
                422,
                'One or more score components exceed the configured maximum or contain invalid marks.'
            );

            $calculatedMarks += (int) $marks;
        }

        abort_unless(
            (int) $result->marks_obtained === $calculatedMarks,
            422,
            'The recorded total marks do not match the individual score components.'
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

    public function approve(ExaminationResult $result)
    {
        DB::transaction(function () use ($result) {
            $lockedResult = ExaminationResult::query()
                ->whereKey($result->id)
                ->lockForUpdate()
                ->firstOrFail();

            abort_unless(
                $lockedResult->status === 'pending_approval',
                403,
                'This result is not awaiting administrator approval.'
            );

            $this->verifyResultForApproval($lockedResult);

            $lockedResult->update([
                'status' => 'approved',
                'approved_by' => auth()->id(),
                'approved_at' => now(),
            ]);
        });

        return redirect()
            ->route('cbt.admin.results.index')
            ->with('success', 'Student result approved successfully.');
    }

    public function reject(Request $request, ExaminationResult $result)
    {
        $validated = $request->validate([
            'rejection_reason' => [
                'required',
                'string',
                'min:5',
                'max:5000',
            ],
        ], [
            'rejection_reason.required' =>
                'Please provide a reason for rejecting this result.',
            'rejection_reason.min' =>
                'The rejection reason must contain at least 5 characters.',
        ]);

        DB::transaction(function () use ($result, $validated) {
            $lockedResult = ExaminationResult::query()
                ->whereKey($result->id)
                ->lockForUpdate()
                ->firstOrFail();

            abort_unless(
                $lockedResult->status === 'pending_approval',
                403,
                'This result is not awaiting administrator approval.'
            );

            $existingRemarks = trim($lockedResult->remarks ?? '');

            $rejectionRemark = 'Administrator rejection reason: '
                . $validated['rejection_reason'];

            $combinedRemarks = $existingRemarks !== ''
                ? $existingRemarks . "\n\n" . $rejectionRemark
                : $rejectionRemark;

            $lockedResult->update([
                'status' => 'rejected',
                'remarks' => $combinedRemarks,
                'approved_by' => null,
                'approved_at' => null,
            ]);
        });

        return redirect()
            ->route('cbt.admin.results.index')
            ->with('success', 'Student result rejected successfully.');
    }
}

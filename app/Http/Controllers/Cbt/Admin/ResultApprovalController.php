<?php

namespace App\Http\Controllers\Cbt\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExaminationResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultApprovalController extends Controller
{
    /**
     * Display results awaiting administrator approval.
     */
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


    /**
     * Display an individual student result.
     */
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


    /**
     * Approve a result for student access.
     */
    public function approve(ExaminationResult $result)
    {
        DB::transaction(function () use ($result) {

            $lockedResult = ExaminationResult::whereKey($result->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($lockedResult->status !== 'pending_approval') {
                abort(403, 'This result is not awaiting administrator approval.');
            }

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


    /**
     * Reject a result and record the administrator's reason.
     */
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
            'rejection_reason.required' => 'Please provide a reason for rejecting this result.',
            'rejection_reason.min' => 'The rejection reason must contain at least 5 characters.',
        ]);

        DB::transaction(function () use ($result, $validated) {

            $lockedResult = ExaminationResult::whereKey($result->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($lockedResult->status !== 'pending_approval') {
                abort(403, 'This result is not awaiting administrator approval.');
            }

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

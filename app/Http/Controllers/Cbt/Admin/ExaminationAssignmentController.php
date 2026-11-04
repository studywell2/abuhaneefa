<?php

namespace App\Http\Controllers\Cbt\Admin;

use App\Http\Controllers\Controller;
use App\Models\Examination;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ExaminationAssignmentController extends Controller
{
    /**
     * Display examiners assigned to an examination
     * and the available active examiners.
     */
    public function index(Examination $examination)
    {
        $examination->load([
            'schoolClass',
            'examiners',
        ]);

        $examiners = User::where('role', 'examiner')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('cbt.admin.examinations.assign-examiners', [
            'examination' => $examination,
            'examiners' => $examiners,
            'assignedExaminers' => $examination->examiners,
        ]);
    }

    /**
     * Save examiner assignments for an examination.
     */
    public function update(Request $request, Examination $examination)
    {
        $validated = $request->validate([
            'examiner_ids' => ['nullable', 'array'],
            'examiner_ids.*' => [
                'integer',
                'distinct',
                Rule::exists('users', 'id')
                    ->where('role', 'examiner')
                    ->where('is_active', true),
            ],
        ], [
            'examiner_ids.*.exists' =>
                'One or more selected examiners are invalid or inactive.',
            'examiner_ids.*.distinct' =>
                'An examiner cannot be selected more than once.',
        ]);

        $selectedIds = $validated['examiner_ids'] ?? [];

        DB::transaction(function () use ($examination, $selectedIds, $request) {
            // Keep the original assignment date for examiners
            // who are already assigned.
            $existingAssignments = $examination->examinerAssignments()
                ->get()
                ->keyBy('examiner_id');

            $assignments = [];

            foreach ($selectedIds as $examinerId) {
                $existing = $existingAssignments->get($examinerId);

                $assignments[$examinerId] = [
                    'assigned_by' => $request->user()->id,
                    'assigned_at' => $existing
                        ? $existing->assigned_at
                        : now(),
                ];
            }

            // Add new assignments and remove assignments
            // that the administrator has deselected.
            $examination->examiners()->sync($assignments);
        });

        return redirect()
            ->route('cbt.admin.examinations.examiners.index', $examination)
            ->with('success', 'Examiner assignments updated successfully.');
    }
}

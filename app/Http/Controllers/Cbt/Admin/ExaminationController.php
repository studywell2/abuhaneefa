<?php

namespace App\Http\Controllers\Cbt\Admin;

use App\Http\Controllers\Controller;
use App\Models\Examination;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExaminationController extends Controller
{
    public function index()
    {
        $totalExaminations = Examination::count();

        $draftExaminations = Examination::where('status', 'draft')->count();

        $publishedExaminations = Examination::where('status', 'published')->count();

        $completedExaminations = Examination::where('status', 'completed')->count();

        $examinations = Examination::with('schoolClass')
            ->latest()
            ->paginate(10);

        return view('cbt.admin.examinations.index', compact(
            'totalExaminations',
            'draftExaminations',
            'publishedExaminations',
            'completedExaminations',
            'examinations'
        ));
    }

    public function create()
    {
        $classes = SchoolClass::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('cbt.admin.examinations.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules());

        Examination::create([
            ...$validated,
            'status' => 'draft',
            'created_by' => auth()->id(),
        ]);

        return redirect()
            ->route('cbt.admin.examinations.index')
            ->with('success', 'Examination created successfully.');
    }

    public function edit(Examination $examination)
    {
        $classes = SchoolClass::where('is_active', true)
            ->orderBy('name')
            ->get();

        $allocatedMarks = $examination->questions()->sum('marks');

        return view('cbt.admin.examinations.edit', compact(
            'examination',
            'classes',
            'allocatedMarks'
        ));
    }

    public function update(Request $request, Examination $examination)
    {
        $validated = $request->validate($this->validationRules());

        $allocatedMarks = $examination->questions()->sum('marks');

        if ($validated['total_marks'] < $allocatedMarks) {
            return back()
                ->withInput()
                ->withErrors([
                    'total_marks' => 'The total marks cannot be less than the marks already assigned to examination questions (' . $allocatedMarks . ').'
                ]);
        }

        $examination->update($validated);

        return redirect()
            ->route('cbt.admin.examinations.index')
            ->with('success', 'Examination updated successfully.');
    }

    public function changeStatus(Request $request, Examination $examination)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:draft,published,completed,cancelled',
            ],
        ]);

        // Check examination readiness before publishing.
        if ($validated['status'] === 'published') {

            $questionCount = $examination->questions()->count();

            $allocatedMarks = $examination->questions()->sum('marks');

            if ($questionCount === 0) {
                return back()->withErrors([
                    'status' => 'You cannot publish an examination without questions.',
                ]);
            }

            if ($allocatedMarks != $examination->total_marks) {
                return back()->withErrors([
                    'status' => 'The question marks must add up to the examination total marks before publishing.',
                ]);
            }

            if (!$examination->start_time || !$examination->end_time) {
                return back()->withErrors([
                    'status' => 'Set the examination start and end times before publishing.',
                ]);
            }
        }

        $examination->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('cbt.admin.examinations.index')
            ->with('success', 'Examination status updated successfully.');
    }

    public function destroy(Examination $examination)
    {
        DB::transaction(function () use ($examination) {
            // Delete the examination questions first.
            $examination->questions()->delete();

            // Delete the examination.
            $examination->delete();
        });

        return redirect()
            ->route('cbt.admin.examinations.index')
            ->with('success', 'Examination deleted successfully.');
    }

    private function validationRules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'subject' => [
                'required',
                'string',
                'max:255',
            ],

            'school_class_id' => [
                'required',
                'exists:school_classes,id',
            ],

            'academic_year' => [
                'required',
                'string',
                'max:20',
            ],

            'term' => [
                'required',
                'in:First,Second,Third',
            ],

            'duration_minutes' => [
                'required',
                'integer',
                'min:1',
            ],

            'total_marks' => [
                'required',
                'integer',
                'min:1',
            ],

            'pass_mark' => [
                'required',
                'integer',
                'min:0',
                'lte:total_marks',
            ],

            'mode' => [
                'required',
                'in:online,physical',
            ],

            'start_time' => [
                'nullable',
                'date',
            ],

            'end_time' => [
                'nullable',
                'date',
                'after:start_time',
            ],

            'instructions' => [
                'nullable',
                'string',
            ],
        ];
    }
}
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

        $departments = ['Science', 'Arts', 'Commercial'];

        return view('cbt.admin.examinations.create', compact(
            'classes',
            'departments'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules());

        $class = SchoolClass::findOrFail($validated['school_class_id']);

        // JSS classes do not have departments.
        if (!str_starts_with(strtoupper($class->name), 'SS')) {

            if (!empty($validated['department'])) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'department' => 'Departments are only available for senior secondary classes.',
                    ]);
            }

            $validated['department'] = null;
        }

        $totalMarks = $this->calculateTotalMarks($validated);

        if ($totalMarks < 1) {
            return back()
                ->withInput()
                ->withErrors([
                    'ca_total' => 'The combined maximum marks must be greater than zero.',
                ]);
        }

        if ($validated['pass_mark'] > $totalMarks) {
            return back()
                ->withInput()
                ->withErrors([
                    'pass_mark' => 'The pass mark cannot exceed the combined examination total.',
                ]);
        }

        $validated['total_marks'] = $totalMarks;

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

        $departments = ['Science', 'Arts', 'Commercial'];

        $allocatedMarks = $examination->questions()->sum('marks');

        return view('cbt.admin.examinations.edit', compact(
            'examination',
            'classes',
            'departments',
            'allocatedMarks'
        ));
    }

    public function update(Request $request, Examination $examination)
    {
        $validated = $request->validate($this->validationRules());

        $class = SchoolClass::findOrFail($validated['school_class_id']);

        // JSS classes do not have departments.
        if (!str_starts_with(strtoupper($class->name), 'SS')) {

            if (!empty($validated['department'])) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'department' => 'Departments are only available for senior secondary classes.',
                    ]);
            }

            $validated['department'] = null;
        }

        $totalMarks = $this->calculateTotalMarks($validated);

        if ($totalMarks < 1) {
            return back()
                ->withInput()
                ->withErrors([
                    'ca_total' => 'The combined maximum marks must be greater than zero.',
                ]);
        }

        if ($validated['pass_mark'] > $totalMarks) {
            return back()
                ->withInput()
                ->withErrors([
                    'pass_mark' => 'The pass mark cannot exceed the combined examination total.',
                ]);
        }

        $hasAttempts = DB::table('examination_attempts')
            ->where('examination_id', $examination->id)
            ->exists();

        // Protect examination class and department after attempts exist.
        if ($hasAttempts) {

            $classOrDepartmentChanged =
                (int) $validated['school_class_id'] !== (int) $examination->school_class_id ||
                ($validated['department'] ?? null) !== $examination->department;

            if ($classOrDepartmentChanged) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'department' => 'The class or department cannot be changed because students have already attempted this examination.',
                    ]);
            }

            // Do not change scoring structure after students have attempted.
            $scoresChanged =
                (int) $validated['ca_total'] !== (int) $examination->ca_total ||
                (int) $validated['objective_total'] !== (int) $examination->objective_total ||
                (int) $validated['theory_total'] !== (int) $examination->theory_total;

            if ($scoresChanged) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'ca_total' => 'The scoring structure cannot be changed because students have already attempted this examination.',
                    ]);
            }
        }

        // Existing online questions must fit within the objective maximum.
        $allocatedMarks = $examination->questions()->sum('marks');

        if (
            $validated['mode'] === 'online' &&
            $allocatedMarks > $validated['objective_total']
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'objective_total' => 'The objective maximum cannot be less than the marks already assigned to examination questions (' . $allocatedMarks . ').',
                ]);
        }

        $validated['total_marks'] = $totalMarks;

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

        if ($validated['status'] === 'published') {

            // Every examination must have a valid schedule before publishing.
            if (!$examination->start_time || !$examination->end_time) {
                return back()->withErrors([
                    'status' => 'Set the examination start and end times before publishing.',
                ]);
            }

            // Online examinations require objective questions.
            if ($examination->mode === 'online') {

                $questionCount = $examination->questions()->count();

                $allocatedMarks = $examination->questions()->sum('marks');

                if ($questionCount === 0) {
                    return back()->withErrors([
                        'status' => 'You cannot publish an online examination without objective questions.',
                    ]);
                }

                if ((int) $examination->objective_total < 1) {
                    return back()->withErrors([
                        'status' => 'An online examination must have an objective maximum greater than zero.',
                    ]);
                }

                if ($allocatedMarks != $examination->objective_total) {
                    return back()->withErrors([
                        'status' => 'The objective question marks must add up to the Objective Maximum Marks before publishing.',
                    ]);
                }
            }

            // Physical examinations use the separate manual score-entry process.
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
        // Protect examinations that already have student attempts.
        $hasAttempts = DB::table('examination_attempts')
            ->where('examination_id', $examination->id)
            ->exists();

        if ($hasAttempts) {
            return redirect()
                ->route('cbt.admin.examinations.index')
                ->withErrors([
                    'examination' => 'This examination cannot be deleted because student attempts already exist.',
                ]);
        }

        DB::transaction(function () use ($examination) {

            $examination->questions()->delete();

            $examination->delete();

        });

        return redirect()
            ->route('cbt.admin.examinations.index')
            ->with('success', 'Examination deleted successfully.');
    }

    private function calculateTotalMarks(array $validated): int
    {
        return (int) $validated['ca_total']
            + (int) $validated['objective_total']
            + (int) $validated['theory_total'];
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

            'department' => [
                'nullable',
                'in:Science,Arts,Commercial',
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

            'ca_total' => [
                'required',
                'integer',
                'min:0',
            ],

            'objective_total' => [
                'required',
                'integer',
                'min:0',
            ],

            'theory_total' => [
                'required',
                'integer',
                'min:0',
            ],

            'pass_mark' => [
                'required',
                'integer',
                'min:0',
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

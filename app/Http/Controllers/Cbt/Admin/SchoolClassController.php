<?php

namespace App\Http\Controllers\Cbt\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SchoolClassController extends Controller
{
    /**
     * Available class options.
     */
    private const GRADES = [
        'Pry 1',
        'Pry 2',
        'Pry 3',
        'Pry 4',
        'Pry 5',
        'Pry 6',
        'JSS1',
        'JSS2',
        'JSS3',
        'SS1',
        'SS2',
        'SS3',
        'Ibtidaaiyah',
        'Idaadiyah',
        'Thanawiyah',
    ];

    /**
     * Display all school classes.
     */
    public function index()
    {
        $classes = SchoolClass::withCount('students')
            ->orderBy('level')
            ->orderBy('name')
            ->paginate(15);

        $totalClasses = SchoolClass::count();
        $activeClasses = SchoolClass::where('is_active', true)->count();
        $inactiveClasses = SchoolClass::where('is_active', false)->count();

        return view('cbt.admin.classes.index', compact(
            'classes',
            'totalClasses',
            'activeClasses',
            'inactiveClasses'
        ));
    }

    /**
     * Show the create class form.
     */
    public function create()
    {
        return view('cbt.admin.classes.create');
    }

    /**
     * Determine the school level for a class.
     */
    private function getLevel(string $grade): string
    {
        if (str_starts_with($grade, 'Pry')) {
            return 'Primary';
        }

        if (str_starts_with($grade, 'JSS')) {
            return 'Junior Secondary';
        }

        if (str_starts_with($grade, 'SS')) {
            return 'Senior Secondary';
        }

        return 'Islamic Studies';
    }

    /**
     * Store a new school class.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'grade' => [
                'required',
                'string',
                Rule::in(self::GRADES),
            ],
            'department' => [
                'nullable',
                'required_if:grade,SS1,SS2,SS3',
                'string',
                Rule::in(['Science', 'Arts', 'Commercial']),
            ],
            'is_active' => [
                'required',
                'boolean',
            ],
        ]);

        $grade = $validated['grade'];

        $isSenior = in_array($grade, ['SS1', 'SS2', 'SS3']);

        $department = $isSenior
            ? $validated['department']
            : null;

        $name = $department
            ? $grade . ' ' . $department
            : $grade;

        $duplicate = SchoolClass::where('name', $name)->exists();

        if ($duplicate) {
            return back()
                ->withErrors([
                    'grade' => 'This class and department already exist.',
                ])
                ->withInput();
        }

        SchoolClass::create([
            'name' => $name,
            'level' => $this->getLevel($grade),
            'arm' => $department,
            'is_active' => $validated['is_active'],
        ]);

        return redirect()
            ->route('cbt.admin.classes.index')
            ->with('success', 'School class created successfully.');
    }

    /**
     * Show the edit class form.
     */
    public function edit(SchoolClass $schoolClass)
    {
        return view('cbt.admin.classes.edit', compact('schoolClass'));
    }

    /**
     * Update an existing school class.
     */
    public function update(Request $request, SchoolClass $schoolClass)
    {
        $validated = $request->validate([
            'grade' => [
                'required',
                'string',
                Rule::in(self::GRADES),
            ],
            'department' => [
                'nullable',
                'required_if:grade,SS1,SS2,SS3',
                'string',
                Rule::in(['Science', 'Arts', 'Commercial']),
            ],
            'is_active' => [
                'required',
                'boolean',
            ],
        ]);

        $grade = $validated['grade'];

        $isSenior = in_array($grade, ['SS1', 'SS2', 'SS3']);

        $department = $isSenior
            ? $validated['department']
            : null;

        $name = $department
            ? $grade . ' ' . $department
            : $grade;

        $duplicate = SchoolClass::where('name', $name)
            ->where('id', '!=', $schoolClass->id)
            ->exists();

        if ($duplicate) {
            return back()
                ->withErrors([
                    'grade' => 'Another class with this grade and department already exists.',
                ])
                ->withInput();
        }

        $schoolClass->update([
            'name' => $name,
            'level' => $this->getLevel($grade),
            'arm' => $department,
            'is_active' => $validated['is_active'],
        ]);

        return redirect()
            ->route('cbt.admin.classes.index')
            ->with('success', 'School class updated successfully.');
    }

    /**
     * Activate or deactivate a school class.
     */
    public function toggleStatus(SchoolClass $schoolClass)
    {
        $schoolClass->update([
            'is_active' => !$schoolClass->is_active,
        ]);

        $message = $schoolClass->is_active
            ? 'School class activated successfully.'
            : 'School class deactivated successfully.';

        return redirect()
            ->route('cbt.admin.classes.index')
            ->with('success', $message);
    }
}

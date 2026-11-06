<?php

namespace App\Http\Controllers\Cbt\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SchoolClassController extends Controller
{
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
     * Store a new school class.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'grade' => [
                'required',
                'string',
                Rule::in(['JSS1', 'JSS2', 'JSS3', 'SS1', 'SS2', 'SS3']),
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

        $isJunior = str_starts_with($validated['grade'], 'JSS');

        $level = $isJunior
            ? 'Junior Secondary'
            : 'Senior Secondary';

        $department = $isJunior
            ? null
            : $validated['department'];

        $name = $department
            ? $validated['grade'] . ' ' . $department
            : $validated['grade'];

        // Check the complete generated class name.
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
            'level' => $level,
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
                Rule::in(['JSS1', 'JSS2', 'JSS3', 'SS1', 'SS2', 'SS3']),
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

        $isJunior = str_starts_with($validated['grade'], 'JSS');

        $level = $isJunior
            ? 'Junior Secondary'
            : 'Senior Secondary';

        $department = $isJunior
            ? null
            : $validated['department'];

        $name = $department
            ? $validated['grade'] . ' ' . $department
            : $validated['grade'];

        // Check for another class with the same complete name.
        // Exclude the class currently being edited.
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
            'level' => $level,
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

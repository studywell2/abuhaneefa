<?php

namespace App\Http\Controllers\Cbt\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Display the student list.
     */
    public function index(Request $request)
    {
        $students = Student::with(['user', 'schoolClass'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->input('search');

                $query->where(function ($studentQuery) use ($search) {
                    $studentQuery
                        ->where('admission_number', 'like', "%{$search}%")
                        ->orWhere('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('email', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate(15)
            ->withQueryString();

        $classes = SchoolClass::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('cbt.admin.students.index', compact('students', 'classes'));
    }

    /**
     * Display the student registration form.
     */
    public function create()
    {
        $classes = SchoolClass::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('cbt.admin.students.create', compact('classes'));
    }

    /**
     * Register a student and create their login account.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'other_names' => ['nullable', 'string', 'max:100'],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'school_class_id' => [
                'required',
                'integer',
                Rule::exists('school_classes', 'id')
                    ->where('is_active', true),
            ],

            'date_of_birth' => [
                'nullable',
                'date',
                'before_or_equal:today',
            ],

            'gender' => [
                'nullable',
                Rule::in(['Male', 'Female']),
            ],

            'guardian_name' => ['nullable', 'string', 'max:255'],
            'guardian_phone' => ['nullable', 'string', 'max:30'],
        ]);

        // Generate a temporary password for the new student.
        $temporaryPassword = Str::random(24);

        // Get the selected class.
        $schoolClass = SchoolClass::findOrFail(
            $validated['school_class_id']
        );

        // Create the account and student profile together.
        $student = DB::transaction(function () use (
            $validated,
            $schoolClass,
            $temporaryPassword
        ) {
            $fullName = trim(implode(' ', array_filter([
                $validated['first_name'],
                $validated['other_names'] ?? null,
                $validated['last_name'],
            ])));

            $user = User::create([
                'name' => $fullName,
                'email' => $validated['email'],
                'password' => $temporaryPassword,
                'role' => 'student',
            ]);

            // Use a temporary unique value until the student ID exists.
            $year = now()->year;

            $student = Student::create([
                'user_id' => $user->id,
                'school_class_id' => $schoolClass->id,
                'admission_number' => 'AHIA-' . $year
                    . '-PENDING-' . Str::uuid(),

                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'other_names' => $validated['other_names'] ?? null,

                // Keep this field populated for compatibility.
                'class_name' => $schoolClass->name,

                'date_of_birth' => $validated['date_of_birth'] ?? null,
                'gender' => $validated['gender'] ?? null,
                'guardian_name' => $validated['guardian_name'] ?? null,
                'guardian_phone' => $validated['guardian_phone'] ?? null,
                'is_active' => true,
            ]);

            // Generate the final unique admission number.
            $student->admission_number = 'AHIA-' . $year . '-'
                . str_pad((string) $student->id, 4, '0', STR_PAD_LEFT);

            $student->save();

            return $student;
        });

        // Display the temporary password once after successful creation.
        return redirect()
            ->route('cbt.admin.students.index')
            ->with('created_student_credentials', [
                'name' => $student->first_name . ' '
                    . $student->last_name,
                'admission_number' => $student->admission_number,
                'email' => $validated['email'],
                'temporary_password' => $temporaryPassword,
            ])
            ->with('success', 'Student registered successfully.');
    }
}

<?php

namespace App\Http\Controllers\Cbt\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
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
        $student = DB::transaction(function () use ($validated, $schoolClass, $temporaryPassword) {
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

    /**
     * Display an individual student profile.
     */
    public function show(Student $student)
    {
        $student->load(['user', 'schoolClass']);

        return view('cbt.admin.students.show', compact('student'));
    }

    /**
     * Display the student edit form.
     */
    public function edit(Student $student)
    {
        $student->load(['user', 'schoolClass']);

        if (!$student->user) {
            abort(404, 'Student login account not found.');
        }

        $classes = SchoolClass::where('is_active', true)
            ->orWhere('id', $student->school_class_id)
            ->orderBy('name')
            ->get();

        return view('cbt.admin.students.edit', compact('student', 'classes'));
    }

    /**
     * Update student information.
     */
    public function update(Request $request, Student $student)
    {
        $student->load('user');

        if (!$student->user) {
            abort(404, 'Student login account not found.');
        }

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'other_names' => ['nullable', 'string', 'max:100'],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($student->user_id),
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

        $schoolClass = SchoolClass::findOrFail(
            $validated['school_class_id']
        );

        DB::transaction(function () use ($validated, $student, $schoolClass) {
            $fullName = trim(implode(' ', array_filter([
                $validated['first_name'],
                $validated['other_names'] ?? null,
                $validated['last_name'],
            ])));

            $student->user->update([
                'name' => $fullName,
                'email' => $validated['email'],
            ]);

            $student->update([
                'school_class_id' => $schoolClass->id,
                'class_name' => $schoolClass->name,
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'other_names' => $validated['other_names'] ?? null,
                'date_of_birth' => $validated['date_of_birth'] ?? null,
                'gender' => $validated['gender'] ?? null,
                'guardian_name' => $validated['guardian_name'] ?? null,
                'guardian_phone' => $validated['guardian_phone'] ?? null,
            ]);
        });

        return redirect()
            ->route('cbt.admin.students.index')
            ->with('success', 'Student details updated successfully.');
    }

    /**
     * Permanently delete a student and their login account.
     */
    public function destroy(Student $student)
    {
        DB::transaction(function () use ($student) {
            $user = $student->user;

            if ($user) {
                $user->delete();
            } else {
                $student->delete();
            }
        });

        return redirect()
            ->route('cbt.admin.students.index')
            ->with('success', 'Student and login account deleted successfully.');
    }

    /**
     * Activate or deactivate a student.
     */
    public function toggleStatus(Student $student)
    {
        $student->update([
            'is_active' => !$student->is_active,
        ]);

        return redirect()
            ->route('cbt.admin.students.index')
            ->with(
                'success',
                $student->is_active
                ? 'Student account activated successfully.'
                : 'Student account deactivated successfully.'
            );
    }

    /**
     * Download the student import template.
     */
    public function downloadTemplate()
    {
        $headers = [
            'first_name',
            'last_name',
            'other_names',
            'email',
            'class_name',
            'date_of_birth',
            'gender',
            'guardian_name',
            'guardian_phone',
        ];

        return response()->streamDownload(function () use ($headers) {
            $file = fopen('php://output', 'w');

            // Add the column headings.
            fputcsv($file, $headers);

            // Add one example row.
            fputcsv($file, [
                'Aisha',
                'Abdullahi',
                'Fatima',
                'aisha@example.com',
                'SS1',
                '2010-05-15',
                'Female',
                'Abdullahi Musa',
                '08012345678',
            ]);

            fclose($file);
        }, 'student_import_template.csv', [
            'Content-Type' => 'text/csv',
        ]);
    }

    
    /**
     * Import multiple students from a CSV file.
     */
    public function import(Request $request)
    {
        $request->validate([
            'students_file' => [
                'required',
                'file',
                'mimes:csv,txt',
                'max:5120',
            ],
        ]);

        $file = fopen($request->file('students_file')->getRealPath(), 'r');

        if (!$file) {
            return back()->with('error', 'Unable to read the uploaded file.');
        }

        $headers = fgetcsv($file);

        if (!$headers) {
            fclose($file);

            return back()->with('error', 'The uploaded CSV file is empty.');
        }

        // Remove spaces and the UTF-8 BOM from column headings.
        $headers = array_map(function ($header) {
            return strtolower(trim((string) $header));
        }, $headers);

        $headers[0] = preg_replace('/^\xEF\xBB\xBF/', '', $headers[0]);

        $requiredHeaders = [
            'first_name',
            'last_name',
            'email',
            'class_name',
        ];

        foreach ($requiredHeaders as $requiredHeader) {
            if (!in_array($requiredHeader, $headers, true)) {
                fclose($file);

                return back()->with(
                    'error',
                    "The CSV file is missing the required column: {$requiredHeader}"
                );
            }
        }

        $classes = SchoolClass::where('is_active', true)
            ->get()
            ->keyBy(fn ($class) => strtolower(trim($class->name)));

        $records = [];
        $credentials = [];
        $errors = [];
        $seenEmails = [];
        $rowNumber = 1;

        while (($values = fgetcsv($file, 0, ',', '"', '\\')) !== false) {
            $rowNumber++;

            // Skip completely empty rows.
            if (count(array_filter($values, fn ($value) => trim((string) $value) !== '')) === 0) {
                continue;
            }

            if (count($values) !== count($headers)) {
                $errors[] = "Row {$rowNumber}: The number of columns does not match the headings.";
                continue;
            }

            $row = array_combine($headers, array_map(
                fn ($value) => trim((string) $value),
                $values
            ));

            $validator = Validator::make($row, [
                'first_name' => ['required', 'string', 'max:100'],
                'last_name' => ['required', 'string', 'max:100'],
                'other_names' => ['nullable', 'string', 'max:100'],
                'email' => ['required', 'email', 'max:255'],
                'class_name' => ['required', 'string', 'max:30'],
                'date_of_birth' => ['nullable', 'date', 'before_or_equal:today'],
                'gender' => ['nullable', Rule::in(['Male', 'Female'])],
                'guardian_name' => ['nullable', 'string', 'max:255'],
                'guardian_phone' => ['nullable', 'string', 'max:30'],
            ]);

            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $message) {
                    $errors[] = "Row {$rowNumber}: {$message}";
                }

                continue;
            }

            $email = strtolower($row['email']);

            if (isset($seenEmails[$email])) {
                $errors[] = "Row {$rowNumber}: This email appears more than once in the uploaded file.";
                continue;
            }

            $seenEmails[$email] = true;

            if (User::whereRaw('LOWER(email) = ?', [$email])->exists()) {
                $errors[] = "Row {$rowNumber}: The email {$row['email']} is already registered.";
                continue;
            }

            $classKey = strtolower(trim($row['class_name']));

            if (!$classes->has($classKey)) {
                $errors[] = "Row {$rowNumber}: The class '{$row['class_name']}' does not exist or is inactive.";
                continue;
            }

            $records[] = [
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'other_names' => $row['other_names'] ?: null,
                'email' => $row['email'],
                'school_class' => $classes->get($classKey),
                'date_of_birth' => $row['date_of_birth'] ?: null,
                'gender' => $row['gender'] ?: null,
                'guardian_name' => $row['guardian_name'] ?: null,
                'guardian_phone' => $row['guardian_phone'] ?: null,
            ];
        }

        fclose($file);

        if (empty($records) && empty($errors)) {
            $errors[] = 'No student records were found in the uploaded file.';
        }

        // Do not import anything if even one row is invalid.
        if (!empty($errors)) {
            return back()->with('import_errors', $errors);
        }

        // Create all accounts and profiles in one database transaction.
        DB::transaction(function () use ($records, &$credentials) {
            foreach ($records as $record) {
                $temporaryPassword = Str::random(24);

                $fullName = trim(implode(' ', array_filter([
                    $record['first_name'],
                    $record['other_names'],
                    $record['last_name'],
                ])));

                $user = User::create([
                    'name' => $fullName,
                    'email' => $record['email'],
                    'password' => $temporaryPassword,
                    'role' => 'student',
                ]);

                $year = now()->year;

                $student = Student::create([
                    'user_id' => $user->id,
                    'school_class_id' => $record['school_class']->id,
                    'admission_number' => 'AHIA-' . $year
                        . '-PENDING-' . Str::uuid(),
                    'first_name' => $record['first_name'],
                    'last_name' => $record['last_name'],
                    'other_names' => $record['other_names'],
                    'class_name' => $record['school_class']->name,
                    'date_of_birth' => $record['date_of_birth'],
                    'gender' => $record['gender'],
                    'guardian_name' => $record['guardian_name'],
                    'guardian_phone' => $record['guardian_phone'],
                    'is_active' => true,
                ]);

                $student->admission_number = 'AHIA-' . $year . '-'
                    . str_pad((string) $student->id, 4, '0', STR_PAD_LEFT);

                $student->save();

                $credentials[] = [
                    'admission_number' => $student->admission_number,
                    'student_name' => $fullName,
                    'email' => $record['email'],
                    'temporary_password' => $temporaryPassword,
                ];
            }
        });

        // Download the login details for the successfully imported students.
        return response()->streamDownload(function () use ($credentials) {
            $output = fopen('php://output', 'w');

            fputcsv($output, [
                'admission_number',
                'student_name',
                'email',
                'temporary_password',
            ]);

            foreach ($credentials as $credential) {
                fputcsv($output, $credential);
            }

            fclose($output);
        }, 'student_import_credentials.csv', [
            'Content-Type' => 'text/csv',
        ]);
    }

}

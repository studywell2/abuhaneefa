<?php

namespace App\Http\Controllers\Cbt\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResultPin;
use App\Models\ResultPinPayment;
use App\Models\Student;
use App\Models\Examination;
use App\Services\ResultPinService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ResultPinController extends Controller
{
    /**
     * Display issued result PINs.
     */
    public function index()
    {
        $resultPins = ResultPin::with([
            'student.schoolClass',
            'issuer',
            'payments',
        ])
            ->latest()
            ->paginate(20);

        return view(
            'cbt.admin.result-pins.index',
            compact('resultPins')
        );
    }

    /**
     * Display the form for issuing a result PIN.
     */
    /**
 * Display the form for issuing a result PIN.
 */
public function create()
{
    $students = Student::with('schoolClass')
        ->where('is_active', true)
        ->orderBy('first_name')
        ->get();

    // Get academic years already used for examinations.
    $academicYears = Examination::query()
        ->whereNotNull('academic_year')
        ->distinct()
        ->pluck('academic_year')
        ->filter(function ($year) {
            return preg_match('/^(\d{4})\/(\d{4})$/', $year);
        })
        ->unique()
        ->values()
        ->all();

    // Sort academic years chronologically.
    usort($academicYears, function ($a, $b) {
        return (int) substr($a, 0, 4)
            <=> (int) substr($b, 0, 4);
    });

    // Include the next academic year automatically.
    if (!empty($academicYears)) {
        $latestYear = end($academicYears);
            $startYear = (int) substr($latestYear, 5, 4);
    } else {
        $startYear = now()->month >= 8
            ? now()->year
            : now()->year - 1;
    }

    $nextAcademicYear = $startYear . '/' . ($startYear + 1);

    if (!in_array($nextAcademicYear, $academicYears, true)) {
        $academicYears[] = $nextAcademicYear;
    }

    $terms = [
        'First',
        'Second',
        'Third',
    ];

    return view(
        'cbt.admin.result-pins.create',
        compact('students', 'academicYears', 'terms')
    );
}    /**
     * Record payment and issue a result PIN.
     */
    public function store(
        Request $request,
        ResultPinService $pinService
    ) {
        $validated = $request->validate([
            'student_id' => [
                'required',
                Rule::exists('students', 'id')
                    ->where('is_active', true),
            ],

            'amount_paid' => [
                'required',
                'numeric',
                'gt:0',
                'decimal:0,2',
                'max:9999999999.99',
            ],

            'payment_method' => [
                'required',
                Rule::in(['Cash', 'Bank Transfer', 'POS']),
            ],

            'payment_reference' => [
                'required',
                'string',
                'max:100',
                Rule::unique('result_pin_payments', 'payment_reference'),
            ],

            'paid_at' => [
                'required',
                'date',
                'before_or_equal:today',
            ],

            'notes' => [
                'nullable',
                'string',
            ],

            'start_academic_year' => [
                'required',
                'regex:/^\d{4}\/\d{4}$/',
            ],

            'start_term' => [
                'required',
                Rule::in(['First', 'Second', 'Third']),
            ],
        ], [
            'student_id.exists' =>
                'Please select an active registered student.',

            'amount_paid.gt' =>
                'Payment amount must be greater than ₦0.',

            'payment_reference.unique' =>
                'This payment reference has already been recorded.',

            'paid_at.before_or_equal' =>
                'Payment date cannot be in the future.',

            'start_academic_year.regex' =>
                'Academic year must use the format YYYY/YYYY.',
        ]);

        $years = explode('/', $validated['start_academic_year']);

        if ((int) $years[1] !== (int) $years[0] + 1) {
            return back()
                ->withInput()
                ->withErrors([
                    'start_academic_year' =>
                        'The academic year must contain two consecutive years.',
                ]);
        }

        $period = $pinService->getTwoTermPeriod(
            $validated['start_academic_year'],
            $validated['start_term']
        );

        $issued = DB::transaction(function () use (
            $validated,
            $pinService,
            $period
        ) {
            $student = Student::whereKey($validated['student_id'])
                ->where('is_active', true)
                ->lockForUpdate()
                ->firstOrFail();

            do {
                $plainPin = $pinService->generatePin();
                $pinHash = $pinService->hashPin($plainPin);
            } while (
                ResultPin::where('pin_hash', $pinHash)->exists()
            );

            $resultPin = ResultPin::create([
                'student_id' => $student->id,
                'pin_hash' => $pinHash,
                'start_academic_year' => $period['start_academic_year'],
                'start_term' => $period['start_term'],
                'end_academic_year' => $period['end_academic_year'],
                'end_term' => $period['end_term'],
                'issued_by' => auth()->id(),
                'issued_at' => now(),
                'status' => 'active',
            ]);

            ResultPinPayment::create([
                'student_id' => $student->id,
                'result_pin_id' => $resultPin->id,
                'amount_paid' => $validated['amount_paid'],
                'currency' => 'NGN',
                'payment_method' => $validated['payment_method'],
                'payment_reference' => $validated['payment_reference'],
                'recorded_by' => auth()->id(),
                'paid_at' => $validated['paid_at'],
                'notes' => $validated['notes'] ?? null,
            ]);

            return [
                'pin' => $plainPin,
                'student_name' => trim(
                    $student->first_name . ' ' .
                    ($student->other_names ?? '') . ' ' .
                    $student->last_name
                ),
            ];
        });

        return redirect()
            ->route('cbt.admin.result-pins.index')
            ->with('success', 'Payment recorded and Result PIN issued successfully.')
            ->with('issued_pin', $issued['pin'])
            ->with('issued_student', $issued['student_name']);
    }

    /**
     * Display an individual result PIN.
     */
    public function show(ResultPin $resultPin)
    {
        $resultPin->load([
            'student.schoolClass',
            'issuer',
            'revoker',
            'payments.recorder',
        ]);

        return view(
            'cbt.admin.result-pins.show',
            compact('resultPin')
        );
    }

    /**
     * Revoke an active result PIN.
     */
    public function revoke(
        Request $request,
        ResultPin $resultPin
    ) {
        $validated = $request->validate([
            'revocation_reason' => [
                'required',
                'string',
                'min:5',
                'max:500',
            ],
        ], [
            'revocation_reason.required' =>
                'Please provide a reason for revoking this PIN.',

            'revocation_reason.min' =>
                'The reason must contain at least 5 characters.',
        ]);

        DB::transaction(function () use ($resultPin, $validated) {

            $lockedPin = ResultPin::whereKey($resultPin->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($lockedPin->status !== 'active') {
                abort(403, 'Only active result PINs can be revoked.');
            }

            $lockedPin->update([
                'status' => 'revoked',
                'revoked_by' => auth()->id(),
                'revoked_at' => now(),
                'revocation_reason' =>
                    $validated['revocation_reason'],
            ]);
        });

        return redirect()
            ->route('cbt.admin.result-pins.show', $resultPin)
            ->with('success', 'Result PIN revoked successfully.');
    }
}
<?php

namespace App\Http\Controllers\Cbt\Student;

use App\Http\Controllers\Controller;
use App\Models\ExaminationResult;
use App\Models\ResultPin;
use App\Services\ResultPinService;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * Display the Result PIN entry page.
     */
    public function pinForm(Request $request)
    {
        $student = $this->getActiveStudent($request);

        $activePin = ResultPin::where('student_id', $student->id)
            ->where('status', 'active')
            ->exists();

        return view('cbt.student.results.pin', compact('activePin'));
    }

    /**
     * Validate a student's Result PIN.
     */
    public function validatePin(
        Request $request,
        ResultPinService $pinService
    ) {
        $validated = $request->validate([
            'pin' => ['required', 'digits:12'],
        ], [
            'pin.required' => 'Please enter your Result PIN.',
            'pin.digits' => 'Your Result PIN must contain exactly 12 digits.',
        ]);

        $student = $this->getActiveStudent($request);

        $submittedHash = $pinService->hashPin($validated['pin']);

        $resultPin = ResultPin::where('student_id', $student->id)
            ->where('pin_hash', $submittedHash)
            ->where('status', 'active')
            ->first();

        if (!$resultPin) {
            return back()->withErrors([
                'pin' => 'Invalid or inactive Result PIN. Please check and try again.',
            ]);
        }

        $request->session()->regenerate();

        $request->session()->put('cbt_result_pin', [
            'student_id' => $student->id,
            'result_pin_id' => $resultPin->id,
        ]);

        return redirect()
            ->route('cbt.student.results.index')
            ->with('success', 'Result PIN verified successfully.');
    }

    /**
     * Display approved results covered by the validated PIN.
     */
    public function index(
        Request $request,
        ResultPinService $pinService
    ) {
        $student = $this->getActiveStudent($request);

        $resultPin = $this->getSessionResultPin(
            $request,
            $student->id
        );

        $allowedPeriods = $this->getAllowedPeriods(
            $resultPin,
            $pinService
        );

        $results = ExaminationResult::query()
            ->with(['attempt.examination'])
            ->where('status', 'approved')
            ->whereHas('attempt', function ($query) use ($student) {
                $query->where('student_id', $student->id);
            })
            ->whereHas('attempt.examination', function ($query) use ($allowedPeriods) {
                $this->applyAllowedPeriods($query, $allowedPeriods);
            })
            ->latest()
            ->get();

        return view(
            'cbt.student.results.index',
            compact('student', 'resultPin', 'results')
        );
    }

    /**
     * Display one individual approved result for printing.
     */
    public function print(
        Request $request,
        ExaminationResult $result,
        ResultPinService $pinService
    ) {
        $student = $this->getActiveStudent($request);

        $resultPin = $this->getSessionResultPin(
            $request,
            $student->id
        );

        $allowedPeriods = $this->getAllowedPeriods(
            $resultPin,
            $pinService
        );

        $result = ExaminationResult::query()
            ->with([
                'attempt.examination.schoolClass',
                'examiner',
                'approver',
            ])
            ->whereKey($result->id)
            ->where('status', 'approved')
            ->whereHas('attempt', function ($query) use ($student) {
                $query->where('student_id', $student->id);
            })
            ->whereHas('attempt.examination', function ($query) use ($allowedPeriods) {
                $this->applyAllowedPeriods($query, $allowedPeriods);
            })
            ->firstOrFail();

        return view(
            'cbt.student.results.print',
            compact('student', 'resultPin', 'result')
        );
    }


    /**
     * Display all approved subject results for one academic term.
     */
    public function consolidated(
        Request $request,
        ResultPinService $pinService
    ) {
        $student = $this->getActiveStudent($request);

        $resultPin = $this->getSessionResultPin(
            $request,
            $student->id
        );

        $allowedPeriods = $this->getAllowedPeriods(
            $resultPin,
            $pinService
        );

        $selectedAcademicYear = $request->query('academic_year');
        $selectedTerm = $request->query('term');

        // Use the first permitted period by default.
        if (!$selectedAcademicYear || !$selectedTerm) {
            $selectedAcademicYear = $allowedPeriods[0]['academic_year'];
            $selectedTerm = $allowedPeriods[0]['term'];
        }

        // Students can only select the two terms covered by their PIN.
        $periodIsAllowed = collect($allowedPeriods)->contains(function ($period) use ($selectedAcademicYear, $selectedTerm) {
            return $period['academic_year'] === $selectedAcademicYear
                && $period['term'] === $selectedTerm;
        });

        abort_unless(
            $periodIsAllowed,
            403,
            'This academic period is not covered by your Result PIN.'
        );

        $results = ExaminationResult::query()
            ->with([
                'attempt.examination.schoolClass',
                'examiner',
                'approver',
            ])
            ->where('status', 'approved')
            ->whereHas('attempt', function ($query) use ($student) {
                $query->where('student_id', $student->id);
            })
            ->whereHas('attempt.examination', function ($query) use ($selectedAcademicYear, $selectedTerm) {
                $query->where('academic_year', $selectedAcademicYear)
                    ->where('term', $selectedTerm);
            })
            ->get()
            ->sortBy(function ($result) {
                return $result->attempt->examination->subject;
            })
            ->values();

        return view(
            'cbt.student.results.consolidated',
            compact(
                'student',
                'resultPin',
                'allowedPeriods',
                'selectedAcademicYear',
                'selectedTerm',
                'results'
            )
        );
    }
    /**
     * Calculate and verify the PIN's exact two-term validity.
     */
    private function getAllowedPeriods(
        ResultPin $resultPin,
        ResultPinService $pinService
    ): array {
        $expectedPeriod = $pinService->getTwoTermPeriod(
            $resultPin->start_academic_year,
            $resultPin->start_term
        );

        abort_unless(
            $resultPin->end_academic_year === $expectedPeriod['end_academic_year']
            && $resultPin->end_term === $expectedPeriod['end_term'],
            403,
            'The Result PIN academic validity period is invalid.'
        );

        return [
            [
                'academic_year' => $expectedPeriod['start_academic_year'],
                'term' => $expectedPeriod['start_term'],
            ],
            [
                'academic_year' => $expectedPeriod['end_academic_year'],
                'term' => $expectedPeriod['end_term'],
            ],
        ];
    }

    /**
     * Restrict examination queries to the PIN's two permitted terms.
     */
    private function applyAllowedPeriods($query, array $allowedPeriods): void
    {
        $query->where(function ($periodQuery) use ($allowedPeriods) {
            foreach ($allowedPeriods as $period) {
                $periodQuery->orWhere(function ($termQuery) use ($period) {
                    $termQuery
                        ->where('academic_year', $period['academic_year'])
                        ->where('term', $period['term']);
                });
            }
        });
    }

    /**
     * Clear the current Result PIN access.
     */
    public function logoutPin(Request $request)
    {
        $request->session()->forget('cbt_result_pin');

        return redirect()
            ->route('cbt.student.results.pin')
            ->with('success', 'Result PIN access has been cleared.');
    }

    /**
     * Get the logged-in student's active record.
     */
    private function getActiveStudent(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->is_active,
            403,
            'Your account is inactive.'
        );

        $student = $user->student;

        abort_unless(
            $student && $student->is_active,
            403,
            'Your student record is inactive or unavailable.'
        );

        return $student;
    }

    /**
     * Confirm the session PIN belongs to this student
     * and remains active.
     */
    private function getSessionResultPin(
        Request $request,
        int $studentId
    ): ResultPin {
        $sessionPin = $request->session()->get('cbt_result_pin');

        abort_unless(
            is_array($sessionPin)
            && ($sessionPin['student_id'] ?? null) === $studentId
            && !empty($sessionPin['result_pin_id']),
            403,
            'Please validate your Result PIN first.'
        );

        $resultPin = ResultPin::whereKey(
            $sessionPin['result_pin_id']
        )
            ->where('student_id', $studentId)
            ->where('status', 'active')
            ->first();

        if (!$resultPin) {
            $request->session()->forget('cbt_result_pin');

            abort(
                403,
                'Your Result PIN is no longer active. Please validate another PIN.'
            );
        }

        return $resultPin;
    }
}

<?php

namespace App\Http\Controllers\Cbt\Student;

use App\Http\Controllers\Controller;
use App\Models\Examination;
use App\Models\ExaminationAttempt;
use App\Models\ExaminationResult;
use App\Models\StudentAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExaminationController extends Controller
{
    /**
     * Confirm that the student is active and has an active student record.
     */
    private function getActiveStudent(Request $request)
    {
        $user = $request->user();

        abort_unless($user && $user->is_active, 403, 'Your account is inactive.');

        $student = $user->student;

        abort_unless(
            $student && $student->is_active,
            403,
            'Your student record is inactive or unavailable.'
        );

        $student->loadMissing('schoolClass');

        return $student;
    }

    /**
     * Confirm that an examination belongs to the student's class
     * and department.
     *
     * Senior students can access:
     * - Their own departmental examinations.
     * - General examinations with no department.
     *
     * Junior students can access:
     * - Their own class examinations without a department.
     */
    private function authorizeStudentForExamination($student, Examination $examination): void
    {
        abort_unless(
            (int) $examination->school_class_id === (int) $student->school_class_id,
            403,
            'You are not authorised to access this examination.'
        );

        $className = $student->schoolClass?->name ?? '';

        $isSeniorClass = str_starts_with($className, 'SS');

        if ($isSeniorClass) {
            if (
                $examination->department !== null
                && $examination->department !== $student->department
            ) {
                abort(403, 'You are not authorised to access this departmental examination.');
            }
        } else {
            abort_unless(
                $examination->department === null,
                403,
                'This examination is not available to your class.'
            );
        }
    }

    /**
     * Display examinations available to the logged-in student.
     */
    public function index(Request $request)
    {
        $student = $this->getActiveStudent($request);

        $className = $student->schoolClass?->name ?? '';

        $isSeniorClass = str_starts_with($className, 'SS');

        $examinationsQuery = Examination::query()
            ->where('school_class_id', $student->school_class_id)
            ->where('mode', 'online')
            ->where('status', 'published')
            ->where('end_time', '>', now());

        if ($isSeniorClass) {
            // Senior students see general examinations and their own department.
            $examinationsQuery->where(function ($query) use ($student) {
                $query->whereNull('department');

                if ($student->department !== null) {
                    $query->orWhere('department', $student->department);
                }
            });
        } else {
            // Junior examinations must not have a department.
            $examinationsQuery->whereNull('department');
        }

        $examinations = $examinationsQuery
            ->with('schoolClass')
            ->latest('start_time')
            ->paginate(10);

        return view(
            'cbt.student.examinations.index',
            compact('examinations')
        );
    }

    /**
     * Display examination instructions before the student starts.
     */
    public function show(Request $request, Examination $examination)
    {
        $student = $this->getActiveStudent($request);

        $this->authorizeStudentForExamination($student, $examination);

        abort_unless(
            $examination->mode === 'online'
            && $examination->status === 'published',
            404
        );

        abort_if(
            !$examination->end_time
            || now()->greaterThanOrEqualTo($examination->end_time),
            403,
            'This examination has ended.'
        );

        $examination->load('schoolClass');

        return view(
            'cbt.student.examinations.show',
            compact('examination')
        );
    }

    /**
     * Start an online examination.
     */
    public function start(Request $request, Examination $examination)
    {
        $student = $this->getActiveStudent($request);

        $this->authorizeStudentForExamination($student, $examination);

        abort_unless(
            $examination->mode === 'online'
            && $examination->status === 'published',
            404
        );

        abort_if(
            !$examination->start_time || !$examination->end_time,
            403,
            'The examination schedule is incomplete.'
        );

        abort_if(
            now()->lessThan($examination->start_time),
            403,
            'This examination has not started yet.'
        );

        abort_if(
            now()->greaterThanOrEqualTo($examination->end_time),
            403,
            'This examination has ended.'
        );

        abort_if(
            !$examination->questions()->exists(),
            403,
            'This examination has no questions.'
        );

        $attempt = DB::transaction(function () use ($student, $examination) {

            $existingAttempt = ExaminationAttempt::where(
                'student_id',
                $student->id
            )
                ->where('examination_id', $examination->id)
                ->lockForUpdate()
                ->first();

            if ($existingAttempt) {
                return $existingAttempt;
            }

            return ExaminationAttempt::create([
                'student_id' => $student->id,
                'examination_id' => $examination->id,
                'started_at' => now(),
                'status' => 'in_progress',
            ]);
        });

        if ($attempt->status !== 'in_progress') {
            return redirect()
                ->route('cbt.student.examinations.index')
                ->with('error', 'You have already submitted this examination.');
        }

        return redirect()->route(
            'cbt.student.examinations.attempt',
            $examination
        );
    }

    /**
     * Display questions for the student's active examination attempt.
     */
    public function attempt(Request $request, Examination $examination)
    {
        $student = $this->getActiveStudent($request);

        $this->authorizeStudentForExamination($student, $examination);

        abort_unless(
            $examination->mode === 'online'
            && $examination->status === 'published',
            404
        );

        $attempt = ExaminationAttempt::query()
            ->where('student_id', $student->id)
            ->where('examination_id', $examination->id)
            ->firstOrFail();

        abort_unless(
            $attempt->status === 'in_progress',
            403,
            'This examination attempt is no longer active.'
        );

        $deadline = $attempt->started_at
            ->copy()
            ->addMinutes($examination->duration_minutes);

        if ($examination->end_time->lessThan($deadline)) {
            $deadline = $examination->end_time->copy();
        }

        if (now()->greaterThanOrEqualTo($deadline)) {
            $this->finalizeAttempt($attempt, $examination);

            return redirect()
                ->route('cbt.student.examinations.index')
                ->with(
                    'error',
                    'Your examination time has expired. Your answers have been submitted.'
                );
        }

        $remainingSeconds = max(
            0,
            (int) now()->diffInSeconds($deadline, false)
        );

        // Never send correct answers to the student.
        $questions = $examination->questions()->get([
            'id',
            'examination_id',
            'question_text',
            'option_a',
            'option_b',
            'option_c',
            'option_d',
            'marks',
            'question_order',
        ]);

        $savedAnswers = StudentAnswer::query()
            ->where('examination_attempt_id', $attempt->id)
            ->pluck('selected_option', 'examination_question_id');

        return view(
            'cbt.student.examinations.attempt',
            compact(
                'examination',
                'attempt',
                'questions',
                'deadline',
                'remainingSeconds',
                'savedAnswers'
            )
        );
    }

    /**
     * Save a student's selected answer.
     */
    public function saveAnswer(Request $request, Examination $examination)
    {
        $student = $this->getActiveStudent($request);

        $this->authorizeStudentForExamination($student, $examination);

        abort_unless(
            $examination->mode === 'online'
            && $examination->status === 'published',
            404
        );

        $attempt = ExaminationAttempt::query()
            ->where('student_id', $student->id)
            ->where('examination_id', $examination->id)
            ->firstOrFail();

        abort_unless(
            $attempt->status === 'in_progress',
            403,
            'This examination attempt is no longer active.'
        );

        $deadline = $attempt->started_at
            ->copy()
            ->addMinutes($examination->duration_minutes);

        if (
            !$examination->end_time
            || $examination->end_time->lessThan($deadline)
        ) {
            $deadline = $examination->end_time;
        }

        if (!$deadline || now()->greaterThanOrEqualTo($deadline)) {
            $this->finalizeAttempt($attempt, $examination);

            return response()->json([
                'message' => 'Your examination time has expired.'
            ], 403);
        }

        $validated = $request->validate([
            'question_id' => ['required', 'integer'],
            'selected_option' => ['required', 'in:A,B,C,D'],
        ]);

        $questionExists = $examination->questions()
            ->whereKey($validated['question_id'])
            ->exists();

        abort_unless(
            $questionExists,
            422,
            'Invalid examination question.'
        );

        StudentAnswer::updateOrCreate(
            [
                'examination_attempt_id' => $attempt->id,
                'examination_question_id' => $validated['question_id'],
            ],
            [
                'selected_option' => $validated['selected_option'],
            ]
        );

        return response()->json([
            'message' => 'Answer saved successfully.'
        ]);
    }

    /**
     * Submit the online examination.
     */
    public function submit(Request $request, Examination $examination)
    {
        $student = $this->getActiveStudent($request);

        $this->authorizeStudentForExamination($student, $examination);

        abort_unless(
            $examination->mode === 'online'
            && $examination->status === 'published',
            404
        );

        $attempt = ExaminationAttempt::query()
            ->where('student_id', $student->id)
            ->where('examination_id', $examination->id)
            ->firstOrFail();

        abort_unless(
            $attempt->status === 'in_progress',
            403,
            'This examination has already been submitted.'
        );

        $this->finalizeAttempt($attempt, $examination);

        $result = ExaminationResult::where(
            'examination_attempt_id',
            $attempt->id
        )->first();

        $message = $result && $result->status === 'pending_review'
            ? 'Your examination has been submitted. Your result is awaiting examiner review.'
            : 'Your examination has been submitted. Some score components are awaiting examiner entry.';

        return response()->json([
            'message' => $message
        ]);
    }

    /**
     * Automatically mark online objective questions and create the result.
     *
     * Physical objective marks remain pending for examiner entry.
     */
    private function finalizeAttempt(
        ExaminationAttempt $attempt,
        Examination $examination
    ): void {
        DB::transaction(function () use ($attempt, $examination) {

            $lockedAttempt = ExaminationAttempt::query()
                ->whereKey($attempt->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($lockedAttempt->status !== 'in_progress') {
                return;
            }

            $caTotal = (int) $examination->ca_total;
            $objectiveTotal = (int) $examination->objective_total;
            $theoryTotal = (int) $examination->theory_total;

            // A component with a maximum of zero requires no examiner entry.
            $caMarks = $caTotal === 0 ? 0 : null;
            $theoryMarks = $theoryTotal === 0 ? 0 : null;

            /*
             * Online examinations:
             * Calculate objective marks automatically.
             *
             * Physical examinations:
             * Leave objective marks pending for the examiner.
             */
            if ($examination->mode === 'online') {

                $questions = $examination->questions()
                    ->get(['id', 'correct_option', 'marks']);

                $answers = StudentAnswer::query()
                    ->where('examination_attempt_id', $lockedAttempt->id)
                    ->get()
                    ->keyBy('examination_question_id');

                $objectiveMarks = 0;

                foreach ($questions as $question) {
                    $answer = $answers->get($question->id);

                    if (
                        $answer
                        && $answer->selected_option === $question->correct_option
                    ) {
                        $objectiveMarks += (int) $question->marks;
                    }
                }

                if ($objectiveMarks > $objectiveTotal) {
                    throw new \RuntimeException(
                        'The objective questions exceed the configured objective marks.'
                    );
                }

            } else {

                // Physical objective papers must be marked by an examiner.
                $objectiveMarks = $objectiveTotal === 0 ? 0 : null;
            }

            // Check whether every required component has been completed.
            $allComponentsComplete = (
                $caMarks !== null
                && $objectiveMarks !== null
                && $theoryMarks !== null
            );

            $totalMarks = (int) $examination->total_marks;

            if ($allComponentsComplete) {

                $finalMarks =
                    $caMarks
                    + $objectiveMarks
                    + $theoryMarks;

                $percentage = $totalMarks > 0
                    ? round(($finalMarks / $totalMarks) * 100, 2)
                    : 0;

                $outcome = $finalMarks >= (int) $examination->pass_mark
                    ? 'passed'
                    : 'failed';

                $resultStatus = 'pending_review';

            } else {

                // Do not calculate a final result while marks are incomplete.
                $finalMarks = 0;
                $percentage = 0;
                $outcome = 'pending';
                $resultStatus = 'awaiting_scores';
            }

            // Lock the attempt against further answer submissions.
            $lockedAttempt->update([
                'status' => 'submitted',
                'submitted_at' => now(),
            ]);

            // Create or update the result for this attempt.
            ExaminationResult::updateOrCreate(
                [
                    'examination_attempt_id' => $lockedAttempt->id,
                ],
                [
                    'ca_marks' => $caMarks,
                    'objective_marks' => $objectiveMarks,
                    'theory_marks' => $theoryMarks,
                    'marks_obtained' => $finalMarks,
                    'total_marks' => $totalMarks,
                    'percentage' => $percentage,
                    'outcome' => $outcome,
                    'status' => $resultStatus,
                ]
            );
        });
    }
}

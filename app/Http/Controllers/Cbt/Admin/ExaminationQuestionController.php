<?php

namespace App\Http\Controllers\Cbt\Admin;

use App\Http\Controllers\Controller;
use App\Models\Examination;
use App\Models\ExaminationQuestion;
use Illuminate\Http\Request;

class ExaminationQuestionController extends Controller
{
    /**
     * Prevent question changes after a student has attempted
     * the examination.
     */
    private function ensureNoAttempts(Examination $examination): void
    {
        $hasAttempts = $examination->attempts()->exists();

        abort_if(
            $hasAttempts,
            403,
            'Questions cannot be added, edited or deleted because students have already attempted this examination.'
        );
    }

    /**
     * Display examination questions.
     */
    public function index(Examination $examination)
    {
        $questions = $examination->questions()->paginate(10);

        $questionCount = $examination->questions()->count();

        $allocatedMarks = $examination->questions()->sum('marks');

        return view('cbt.admin.examinations.questions.index', compact(
            'examination',
            'questions',
            'questionCount',
            'allocatedMarks'
        ));
    }

    /**
     * Display the create question form.
     */
    public function create(Examination $examination)
    {
        $this->ensureNoAttempts($examination);

        $allocatedMarks = $examination->questions()->sum('marks');

        return view('cbt.admin.examinations.questions.create', compact(
            'examination',
            'allocatedMarks'
        ));
    }

    /**
     * Store a new examination question.
     */
    public function store(Request $request, Examination $examination)
    {
        $this->ensureNoAttempts($examination);

        $validated = $request->validate([
            'question_text' => ['required', 'string'],
            'option_a' => ['required', 'string'],
            'option_b' => ['required', 'string'],
            'option_c' => ['required', 'string'],
            'option_d' => ['required', 'string'],
            'correct_option' => ['required', 'in:A,B,C,D'],
            'marks' => ['required', 'integer', 'min:1'],
        ]);

        $allocatedMarks = $examination->questions()->sum('marks');

        if (
            ($allocatedMarks + $validated['marks'])
            > $examination->total_marks
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'marks' => 'The marks for this question exceed the remaining marks available for this examination.',
                ]);
        }

        $nextOrder = (
            $examination->questions()->max('question_order') ?? 0
        ) + 1;

        $examination->questions()->create([
            ...$validated,
            'question_order' => $nextOrder,
        ]);

        return redirect()
            ->route(
                'cbt.admin.examinations.questions.index',
                $examination
            )
            ->with('success', 'Question added successfully.');
    }

    /**
     * Display the edit question form.
     */
    public function edit(
        Examination $examination,
        ExaminationQuestion $question
    ) {
        abort_unless(
            (int) $question->examination_id === (int) $examination->id,
            404
        );

        $this->ensureNoAttempts($examination);

        $allocatedMarks = $examination->questions()
            ->where('id', '!=', $question->id)
            ->sum('marks');

        $remainingMarks = $examination->total_marks - $allocatedMarks;

        return view('cbt.admin.examinations.questions.edit', compact(
            'examination',
            'question',
            'allocatedMarks',
            'remainingMarks'
        ));
    }

    /**
     * Update an examination question.
     */
    public function update(
        Request $request,
        Examination $examination,
        ExaminationQuestion $question
    ) {
        abort_unless(
            (int) $question->examination_id === (int) $examination->id,
            404
        );

        $this->ensureNoAttempts($examination);

        $validated = $request->validate([
            'question_text' => ['required', 'string'],
            'option_a' => ['required', 'string'],
            'option_b' => ['required', 'string'],
            'option_c' => ['required', 'string'],
            'option_d' => ['required', 'string'],
            'correct_option' => ['required', 'in:A,B,C,D'],
            'marks' => ['required', 'integer', 'min:1'],
        ]);

        $allocatedMarks = $examination->questions()
            ->where('id', '!=', $question->id)
            ->sum('marks');

        if (
            ($allocatedMarks + $validated['marks'])
            > $examination->total_marks
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'marks' => 'The marks entered exceed the remaining marks available for this examination.',
                ]);
        }

        $question->update($validated);

        return redirect()
            ->route(
                'cbt.admin.examinations.questions.index',
                $examination
            )
            ->with('success', 'Question updated successfully.');
    }

    /**
     * Delete an examination question.
     */
    public function destroy(
        Examination $examination,
        ExaminationQuestion $question
    ) {
        abort_unless(
            (int) $question->examination_id === (int) $examination->id,
            404
        );

        $this->ensureNoAttempts($examination);

        $question->delete();

        return redirect()
            ->route(
                'cbt.admin.examinations.questions.index',
                $examination
            )
            ->with('success', 'Question deleted successfully.');
    }
}

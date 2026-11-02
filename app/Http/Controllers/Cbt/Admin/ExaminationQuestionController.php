<?php

namespace App\Http\Controllers\Cbt\Admin;

use App\Http\Controllers\Controller;
use App\Models\Examination;
use App\Models\ExaminationQuestion;
use Illuminate\Http\Request;

class ExaminationQuestionController extends Controller
{
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

    public function create(Examination $examination)
    {
        $allocatedMarks = $examination->questions()->sum('marks');

        return view('cbt.admin.examinations.questions.create', compact(
            'examination',
            'allocatedMarks'
        ));
    }

    public function store(Request $request, Examination $examination)
    {
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

        if (($allocatedMarks + $validated['marks']) > $examination->total_marks) {
            return back()
                ->withInput()
                ->withErrors([
                    'marks' => 'The marks for this question exceed the remaining marks available for this examination.'
                ]);
        }

        $nextOrder = ($examination->questions()->max('question_order') ?? 0) + 1;

        $examination->questions()->create([
            ...$validated,
            'question_order' => $nextOrder,
        ]);

        return redirect()
            ->route('cbt.admin.examinations.questions.index', $examination)
            ->with('success', 'Question added successfully.');
    }

    public function edit(
        Examination $examination,
        ExaminationQuestion $question
    ) {
        abort_unless(
            (int) $question->examination_id === (int) $examination->id,
            404
        );

        // Exclude the current question from the allocated marks.
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

    public function update(
        Request $request,
        Examination $examination,
        ExaminationQuestion $question
    ) {
        abort_unless(
            (int) $question->examination_id === (int) $examination->id,
            404
        );

        $validated = $request->validate([
            'question_text' => ['required', 'string'],
            'option_a' => ['required', 'string'],
            'option_b' => ['required', 'string'],
            'option_c' => ['required', 'string'],
            'option_d' => ['required', 'string'],
            'correct_option' => ['required', 'in:A,B,C,D'],
            'marks' => ['required', 'integer', 'min:1'],
        ]);

        // Calculate marks without including the current question.
        $allocatedMarks = $examination->questions()
            ->where('id', '!=', $question->id)
            ->sum('marks');

        if (($allocatedMarks + $validated['marks']) > $examination->total_marks) {
            return back()
                ->withInput()
                ->withErrors([
                    'marks' => 'The marks entered exceed the remaining marks available for this examination.'
                ]);
        }

        $question->update($validated);

        return redirect()
            ->route('cbt.admin.examinations.questions.index', $examination)
            ->with('success', 'Question updated successfully.');
    }

    public function destroy(
        Examination $examination,
        ExaminationQuestion $question
    ) {
        abort_unless(
            (int) $question->examination_id === (int) $examination->id,
            404
        );

        $question->delete();

        return redirect()
            ->route('cbt.admin.examinations.questions.index', $examination)
            ->with('success', 'Question deleted successfully.');
    }
}

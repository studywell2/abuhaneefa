<?php

namespace App\Http\Controllers\Cbt\Examiner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $examiner = $request->user();

        // Identify the selected score-management task.
        $scoreTask = $request->query('score_task');

        // Start with examinations assigned to this examiner only.
        $examinationsQuery = $examiner->assignedExaminations()
            ->with('schoolClass')
            ->withCount('questions');

        // Filter examinations with student records awaiting score entry.
        if ($scoreTask === 'entry') {
            $examinationsQuery->whereHas('attempts', function ($query) {
                $query->whereNotNull('submitted_at')
                    ->whereHas('result', function ($resultQuery) {
                        $resultQuery->where('status', 'awaiting_scores');
                    });
            });
        }

        // Filter examinations with scores awaiting examiner review.
        if ($scoreTask === 'review') {
            $examinationsQuery->whereHas('attempts', function ($query) {
                $query->whereNotNull('submitted_at')
                    ->whereHas('result', function ($resultQuery) {
                        $resultQuery->where('status', 'pending_review');
                    });
            });
        }

        $examinations = $examinationsQuery
            ->latest('examinations.created_at')
            ->paginate(10)
            ->withQueryString();

        // Existing dashboard statistics remain unchanged.
        $totalAssigned = $examiner->assignedExaminations()->count();

        $publishedExams = $examiner->assignedExaminations()
            ->where('examinations.status', 'published')
            ->count();

        $completedExams = $examiner->assignedExaminations()
            ->where('examinations.status', 'completed')
            ->count();

        return view('cbt.examiner.dashboard', compact(
            'examinations',
            'totalAssigned',
            'publishedExams',
            'completedExams',
            'scoreTask'
        ));
    }
}

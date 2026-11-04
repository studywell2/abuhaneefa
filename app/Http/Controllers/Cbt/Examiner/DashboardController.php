<?php

namespace App\Http\Controllers\Cbt\Examiner;

use App\Http\Controllers\Controller;
use App\Models\Examination;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $examiner = $request->user();

        // Retrieve only examinations assigned to this examiner.
        $examinations = $examiner->assignedExaminations()
            ->with('schoolClass')
            ->withCount('questions')
            ->latest('examinations.created_at')
            ->paginate(10);

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
            'completedExams'
        ));
    }
}
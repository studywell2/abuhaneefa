<?php

namespace App\Http\Controllers\Cbt\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Models\Examination;
use App\Models\ExaminationResult;

class DashboardController extends Controller
{
    public function index()
    {
        $registeredStudents = Student::count();

        $registeredExaminers = User::where(
            'role',
            'examiner'
        )->count();

        $totalExaminations = Examination::count();

        $resultsAwaitingApproval = ExaminationResult::where(
            'status',
            'pending_approval'
        )->count();

        return view('cbt.admin.dashboard', compact(
            'registeredStudents',
            'registeredExaminers',
            'totalExaminations',
            'resultsAwaitingApproval'
        ));
    }
}
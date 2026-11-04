<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PageController;

use App\Http\Controllers\Cbt\AuthController as CbtAuthController;
use App\Http\Controllers\Cbt\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Cbt\Admin\StudentController;
use App\Http\Controllers\Cbt\Admin\ExaminerController;
use App\Http\Controllers\Cbt\Admin\ExaminationController;
use App\Http\Controllers\Cbt\Admin\ExaminationQuestionController;
use App\Http\Controllers\Cbt\Admin\ExaminationAssignmentController;
use App\Http\Controllers\Cbt\Admin\ResultApprovalController;
use App\Http\Controllers\Cbt\Admin\ResultPinController;

use App\Http\Controllers\Cbt\Examiner\DashboardController as ExaminerDashboardController;
use App\Http\Controllers\Cbt\Examiner\ScoreController as ExaminerScoreController;

use App\Http\Controllers\Cbt\Student\ExaminationController as StudentExaminationController;
use App\Http\Controllers\Cbt\Student\ResultController as StudentResultController;

use Illuminate\Support\Facades\Route;


// ======================================================
// PUBLIC ACADEMY WEBSITE
// ======================================================

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/admissions', [PageController::class, 'admissions'])->name('admissions');
Route::get('/academics', [PageController::class, 'academics'])->name('academics');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');

Route::get('/contact', [ContactController::class, 'create'])
    ->name('contact.create');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');

Route::post('/newsletter', [NewsletterController::class, 'store'])
    ->name('newsletter.store');

Route::view('/contact-print', 'pages.contact-print')
    ->name('contact.print');


// ======================================================
// EXISTING CONTACT MANAGEMENT
// ======================================================

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [AdminController::class, 'index'])
        ->name('index');

    Route::get('/{contact}', [AdminController::class, 'show'])
        ->name('show');

    Route::delete('/{contact}', [AdminController::class, 'destroy'])
        ->name('destroy');

});


// ======================================================
// CBT PORTAL
// ======================================================

Route::prefix('cbt')->name('cbt.')->group(function () {

    // CBT AUTHENTICATION

    Route::get('/login', [CbtAuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [CbtAuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.submit');


    // AUTHENTICATED CBT ROUTES

    Route::middleware('auth')->group(function () {

        // ROLE-BASED DASHBOARD REDIRECT

        Route::get('/dashboard', function () {

            $user = auth()->user();

            return match ($user->role) {

                'administrator' => redirect()->route('cbt.admin.dashboard'),

                'examiner' => redirect()->route('cbt.examiner.dashboard'),

                'student' => redirect()->route('cbt.student.dashboard'),

                default => abort(403, 'Your account has no authorised CBT role.'),

            };

        })->name('dashboard');


        // ==================================================
        // ADMINISTRATOR MODULE
        // ==================================================

        Route::middleware('role:administrator')->group(function () {

            // ADMIN DASHBOARD

            Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
                ->name('admin.dashboard');


            // EXAMINER MANAGEMENT

            Route::get('/admin/examiners', [ExaminerController::class, 'index'])
                ->name('admin.examiners.index');

            Route::get('/admin/examiners/create', [ExaminerController::class, 'create'])
                ->name('admin.examiners.create');

            Route::post('/admin/examiners', [ExaminerController::class, 'store'])
                ->name('admin.examiners.store');

            Route::get('/admin/examiners/{examiner}', [ExaminerController::class, 'show'])
                ->name('admin.examiners.show');

            Route::get('/admin/examiners/{examiner}/edit', [ExaminerController::class, 'edit'])
                ->name('admin.examiners.edit');

            Route::put('/admin/examiners/{examiner}', [ExaminerController::class, 'update'])
                ->name('admin.examiners.update');

            Route::patch('/admin/examiners/{examiner}/status', [ExaminerController::class, 'toggleStatus'])
                ->name('admin.examiners.toggle-status');

            Route::delete('/admin/examiners/{examiner}', [ExaminerController::class, 'destroy'])
                ->name('admin.examiners.destroy');


            // STUDENT MANAGEMENT

            Route::get('/admin/students', [StudentController::class, 'index'])
                ->name('admin.students.index');

            Route::get('/admin/students/import/template', [StudentController::class, 'downloadTemplate'])
                ->name('admin.students.import.template');

            Route::post('/admin/students/import', [StudentController::class, 'import'])
                ->name('admin.students.import');

            Route::get('/admin/students/create', [StudentController::class, 'create'])
                ->name('admin.students.create');

            Route::post('/admin/students', [StudentController::class, 'store'])
                ->name('admin.students.store');

            Route::get('/admin/students/{student}', [StudentController::class, 'show'])
                ->name('admin.students.show');

            Route::get('/admin/students/{student}/edit', [StudentController::class, 'edit'])
                ->name('admin.students.edit');

            Route::put('/admin/students/{student}', [StudentController::class, 'update'])
                ->name('admin.students.update');

            Route::delete('/admin/students/{student}', [StudentController::class, 'destroy'])
                ->name('admin.students.destroy');

            Route::patch('/admin/students/{student}/status', [StudentController::class, 'toggleStatus'])
                ->name('admin.students.toggle-status');


            // EXAMINATION MANAGEMENT

            Route::get('/admin/examinations', [ExaminationController::class, 'index'])
                ->name('admin.examinations.index');

            Route::get('/admin/examinations/create', [ExaminationController::class, 'create'])
                ->name('admin.examinations.create');

            Route::post('/admin/examinations', [ExaminationController::class, 'store'])
                ->name('admin.examinations.store');

            Route::get('/admin/examinations/{examination}/edit', [ExaminationController::class, 'edit'])
                ->name('admin.examinations.edit');

            Route::put('/admin/examinations/{examination}', [ExaminationController::class, 'update'])
                ->name('admin.examinations.update');

            Route::patch('/admin/examinations/{examination}/status', [ExaminationController::class, 'changeStatus'])
                ->name('admin.examinations.change-status');

            Route::delete('/admin/examinations/{examination}', [ExaminationController::class, 'destroy'])
                ->name('admin.examinations.destroy');


            // EXAMINER ASSIGNMENTS

            Route::get('/admin/examinations/{examination}/examiners', [ExaminationAssignmentController::class, 'index'])
                ->name('admin.examinations.examiners.index');

            Route::put('/admin/examinations/{examination}/examiners', [ExaminationAssignmentController::class, 'update'])
                ->name('admin.examinations.examiners.update');


            // EXAMINATION QUESTION MANAGEMENT

            Route::get('/admin/examinations/{examination}/questions', [ExaminationQuestionController::class, 'index'])
                ->name('admin.examinations.questions.index');

            Route::get('/admin/examinations/{examination}/questions/create', [ExaminationQuestionController::class, 'create'])
                ->name('admin.examinations.questions.create');

            Route::post('/admin/examinations/{examination}/questions', [ExaminationQuestionController::class, 'store'])
                ->name('admin.examinations.questions.store');

            Route::delete('/admin/examinations/{examination}/questions/{question}', [ExaminationQuestionController::class, 'destroy'])
                ->name('admin.examinations.questions.destroy');

            Route::get('/admin/examinations/{examination}/questions/{question}/edit', [ExaminationQuestionController::class, 'edit'])
                ->name('admin.examinations.questions.edit');

            Route::put('/admin/examinations/{examination}/questions/{question}', [ExaminationQuestionController::class, 'update'])
                ->name('admin.examinations.questions.update');


            // RESULT APPROVAL MANAGEMENT

            Route::get('/admin/results', [ResultApprovalController::class, 'index'])
                ->name('admin.results.index');

            Route::get('/admin/results/{result}', [ResultApprovalController::class, 'show'])
                ->name('admin.results.show');

            Route::post('/admin/results/{result}/approve', [ResultApprovalController::class, 'approve'])
                ->name('admin.results.approve');

            Route::post('/admin/results/{result}/reject', [ResultApprovalController::class, 'reject'])
                ->name('admin.results.reject');


            // RESULT PIN MANAGEMENT

            Route::get('/admin/result-pins', [ResultPinController::class, 'index'])
                ->name('admin.result-pins.index');

            Route::get('/admin/result-pins/create', [ResultPinController::class, 'create'])
                ->name('admin.result-pins.create');

            Route::post('/admin/result-pins', [ResultPinController::class, 'store'])
                ->name('admin.result-pins.store');

            Route::get('/admin/result-pins/{resultPin}', [ResultPinController::class, 'show'])
                ->name('admin.result-pins.show');

            Route::post('/admin/result-pins/{resultPin}/revoke', [ResultPinController::class, 'revoke'])
                ->name('admin.result-pins.revoke');

        });


        // ==================================================
        // EXAMINER MODULE
        // ==================================================

        Route::middleware('role:examiner')->group(function () {

            Route::get('/examiner/dashboard', [ExaminerDashboardController::class, 'index'])
                ->name('examiner.dashboard');

            Route::get('/examiner/examinations/{examination}/scores', [ExaminerScoreController::class, 'index'])
                ->name('examiner.examinations.scores.index');

            Route::post(
                '/examiner/examinations/{examination}/scores/{result}',
                [ExaminerScoreController::class, 'update']
            )->name('examiner.examinations.scores.update');

            Route::get(
                '/examiner/examinations/{examination}/scores/{result}/review',
                [ExaminerScoreController::class, 'show']
            )->name('examiner.examinations.scores.review');

            Route::post(
                '/examiner/examinations/{examination}/scores/{result}/review',
                [ExaminerScoreController::class, 'review']
            )->name('examiner.examinations.scores.submit-review');

        });


        // ==================================================
        // STUDENT MODULE
        // ==================================================

        Route::middleware('role:student')->group(function () {

            // STUDENT DASHBOARD

            Route::view('/student/dashboard', 'cbt.student.dashboard')
                ->name('student.dashboard');


            // STUDENT EXAMINATIONS

            Route::get('/student/examinations', [StudentExaminationController::class, 'index'])
                ->name('student.examinations.index');

            Route::get('/student/examinations/{examination}', [StudentExaminationController::class, 'show'])
                ->name('student.examinations.show');

            Route::post('/student/examinations/{examination}/start', [StudentExaminationController::class, 'start'])
                ->name('student.examinations.start');

            Route::get('/student/examinations/{examination}/attempt', [StudentExaminationController::class, 'attempt'])
                ->name('student.examinations.attempt');

            Route::post('/student/examinations/{examination}/answer', [StudentExaminationController::class, 'saveAnswer'])
                ->name('student.examinations.answer');

            Route::post('/student/examinations/{examination}/submit', [StudentExaminationController::class, 'submit'])
                ->name('student.examinations.submit');


            // STUDENT RESULT PIN

            Route::get('/student/result-pin', [StudentResultController::class, 'pinForm'])
                ->name('student.results.pin');

            Route::post('/student/result-pin', [StudentResultController::class, 'validatePin'])
                ->middleware('throttle:5,1')
                ->name('student.results.validate-pin');

            Route::post('/student/result-pin/logout', [StudentResultController::class, 'logoutPin'])
                ->name('student.results.logout-pin');


            // STUDENT APPROVED RESULTS

            Route::get('/student/results', [StudentResultController::class, 'index'])
                ->name('student.results.index');

            Route::get('/student/results/consolidated', [StudentResultController::class, 'consolidated'])
                ->name('student.results.consolidated');

            // INDIVIDUAL PRINTABLE RESULT SLIP

            Route::get('/student/results/{result}/print', [StudentResultController::class, 'print'])
                ->name('student.results.print');

        });


        // CBT LOGOUT

        Route::post('/logout', [CbtAuthController::class, 'logout'])
            ->name('logout');

    });

});


// ======================================================
// STANDARD LOGIN REDIRECT
// ======================================================

Route::get('/login', function () {

    return redirect()->route('cbt.login');

})->name('login');

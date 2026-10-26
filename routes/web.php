<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Cbt\AuthController as CbtAuthController;
use App\Http\Controllers\Cbt\Admin\StudentController;
use Illuminate\Support\Facades\Route;

// Public academy website
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/admissions', [PageController::class, 'admissions'])->name('admissions');
Route::get('/academics', [PageController::class, 'academics'])->name('academics');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');
Route::view('/contact-print', 'pages.contact-print')->name('contact.print');

// Existing contact-management routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/{contact}', [AdminController::class, 'show'])->name('show');
    Route::delete('/{contact}', [AdminController::class, 'destroy'])->name('destroy');
});

// CBT portal
Route::prefix('cbt')->name('cbt.')->group(function () {
    Route::get('/login', [CbtAuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [CbtAuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.submit');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            $user = auth()->user();

            return match ($user->role) {
                'administrator' => redirect()->route('cbt.admin.dashboard'),
                'examiner' => redirect()->route('cbt.examiner.dashboard'),
                'student' => redirect()->route('cbt.student.dashboard'),
                default => abort(403, 'Your account has no authorised CBT role.'),
            };
        })->name('dashboard');

        Route::middleware('role:administrator')->group(function () {
            Route::view('/admin/dashboard', 'cbt.admin.dashboard')
                ->name('admin.dashboard');

            Route::get('/admin/students', [StudentController::class, 'index'])
                ->name('admin.students.index');

                Route::get('/admin/students/create', [StudentController::class, 'create'])
               ->name('admin.students.create');

                Route::post('/admin/students', [StudentController::class, 'store'])
               ->name('admin.students.store');
        });

        Route::middleware('role:examiner')->group(function () {
            Route::view('/examiner/dashboard', 'cbt.examiner.dashboard')
                ->name('examiner.dashboard');
        });

        Route::middleware('role:student')->group(function () {
            Route::view('/student/dashboard', 'cbt.student.dashboard')
                ->name('student.dashboard');
        });

        Route::post('/logout', [CbtAuthController::class, 'logout'])
            ->name('logout');
    });
});

// Redirect the standard login URL to the CBT login page
Route::get('/login', function () {
    return redirect()->route('cbt.login');
})->name('login');

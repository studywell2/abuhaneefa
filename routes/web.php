<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/admissions', [PageController::class, 'admissions'])->name('admissions');
Route::get('/academics', [PageController::class, 'academics'])->name('academics');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::view('/contact-print', 'pages.contact-print')->name('contact.print');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/{contact}', [AdminController::class, 'show'])->name('show');
    Route::delete('/{contact}', [AdminController::class, 'destroy'])->name('destroy');
});

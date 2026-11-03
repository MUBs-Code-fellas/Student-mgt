<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));
Route::get('/dashboard', fn () => view('dashboard'))->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    // Breeze profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Administrator only
    Route::middleware('role:Administrator')->group(function () {
        Route::resource('students', StudentController::class);
        Route::resource('courses', CourseController::class)->except(['index', 'show']);
    });

    // Course list for all roles (filtered by role inside the controller)
    Route::get('/courses', [CourseController::class, 'index'])
        ->middleware('role_or_permission:Administrator|view courses|view assigned courses')->name('courses.index');
    Route::get('/courses/{course}/students', [CourseController::class, 'students'])->name('courses.students');

    // Registrations
    Route::get('/registrations', [RegistrationController::class, 'index'])->name('registrations.index');
    Route::middleware('permission:manage registrations')->group(function () {
        Route::get('/registrations/create', [RegistrationController::class, 'create'])->name('registrations.create');
        Route::post('/registrations', [RegistrationController::class, 'store'])->name('registrations.store');
    });
    Route::post('/courses/{course}/register', [RegistrationController::class, 'register'])
        ->middleware('permission:register course')->name('courses.register');
    Route::delete('/registrations/{registration}', [RegistrationController::class, 'destroy'])->name('registrations.destroy');
});

require __DIR__.'/auth.php';

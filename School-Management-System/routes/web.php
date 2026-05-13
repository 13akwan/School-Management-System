<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeachingController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\StudentDashboardController;



Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('users', UserController::class)->except(['show']);
        Route::resource('classes', ClassController::class)->except(['show']);
        Route::resource('subjects', SubjectController::class)->except(['show']);
        Route::resource('teachings', TeachingController::class)->except(['show']);
    });



Route::middleware(['auth', 'role:teacher'])
    ->prefix('teacher')
    ->name('teacher.')
    ->group(function () {

        Route::get('/dashboard', [TeacherDashboardController::class, 'index']) 
            ->name('dashboard');

        Route::resource('tasks', TaskController::class)->except(['show']);
        Route::resource('grades', GradeController::class)->except(['show']);
        Route::resource('attendances', AttendanceController::class)->except(['show']);
        Route::resource('submissions', SubmissionController::class)
            ->only(['index', 'destroy']);
    });



Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        Route::get('/dashboard', [StudentDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('submissions', SubmissionController::class)->except(['show', 'edit', 'update']);

        Route::resource('attendances', AttendanceController::class)->only(['index']);
    });

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');

    Route::post('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::post('/profile/password', [ProfileController::class, 'changePassword'])
        ->name('profile.password');

});



require __DIR__.'/auth.php';
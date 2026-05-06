<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeachingController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\AttendanceController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::resource('students', StudentController::class);
    Route::resource('tasks', TaskController::class);

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

Route::get('/teacher/dashboard', function () {
    return 'Teacher Dashboard';
})
    ->middleware(['auth', 'role:teacher'])
    ->name('teacher.dashboard');

Route::get('/student/dashboard', function () {
    return 'Student Dashboard';
})
    ->middleware(['auth', 'role:student'])
    ->name('student.dashboard');

Route::resource('students', StudentController::class)
    ->except(['show'])
    ->middleware(['auth', 'role:admin']);

Route::resource('classes', ClassController::class)
    ->except(['show'])
    ->middleware(['auth', 'role:admin']);

Route::resource('subjects', SubjectController::class)
    ->except(['show'])
    ->middleware(['auth', 'role:admin']);

Route::resource('teachers', TeacherController::class)
    ->except(['show'])
    ->middleware(['auth', 'role:admin']);

Route::resource('teachings', TeachingController::class)
    ->except(['show', 'edit', 'update'])
    ->middleware(['auth', 'role:admin']);

Route::resource('tasks', TaskController::class)
    ->except(['show', 'edit', 'update'])
    ->middleware(['auth', 'role:teacher']);

Route::resource('submissions', SubmissionController::class)
    ->except(['show', 'edit', 'update'])
    ->middleware(['auth']);

Route::resource('grades', GradeController::class)
    ->except(['show', 'edit', 'update'])
    ->middleware(['auth', 'role:teacher']);

Route::resource('attendances', AttendanceController::class)
    ->except(['show', 'edit', 'update'])
    ->middleware(['auth', 'role:teacher']);

require __DIR__.'/auth.php';

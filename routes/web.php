<?php

use App\Http\Controllers\ClassBatchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if(! Auth::check()){
        return redirect('/class_batch');
    }
    return redirect('/login');
});

//class_batch controller
Route::get('/class_batch', [ClassBatchController::class, 'index']);
Route::get('/class_batch/create', [ClassBatchController::class, 'create']);
Route::post('/class_batch', [ClassBatchController::class, 'store']);
Route::delete('/class_batch/{class_batch}', [ClassBatchController::class, 'destroy']);

//students-profile controller
Route::get('/class_batch/students/{class_batch}', [StudentController::class, 'index'])->name('class_batch_students.index');
Route::get('/class_batch/students/{class_batch}/create', [StudentController::class, 'create']);
Route::post('/class_batch/students/{class_batch}', [StudentController::class, 'store']);
Route::delete('/class_batch/students/{student}', [StudentController::class, 'destroy']);
Route::patch('/class_batch/students/{student}/move', [StudentController::class, 'move']);

//add grades
Route::get('/class_batch/students/{student}/add', [GradeController::class, 'add']);
Route::post('/class_batch/students/{student}/store', [GradeController::class, 'store']);
Route::get('/evaluation/{student}', [GradeController::class, 'evaluation']);

//dashboard
Route::get('/dashboard/students-profile', [DashboardController::class, 'dashboardStudents']);
Route::patch('/dashboard/student/profile/{student}', [DashboardController::class, 'update']);
Route::get('/dashboard/student/profile/{student}', [DashboardController::class, 'studentProfile']);





//subject
Route::get('/subjects', [SubjectController::class, 'index']);
Route::get('/subject/{subject}/edit', [SubjectController::class, 'edit']);
Route::put('/subject/{subject}/update', [SubjectController::class, 'update']);
Route::get('/subject/create', [SubjectController::class, 'create']);
Route::post('/subject', [SubjectController::class, 'store']);
Route::delete('/subject/{subject}', [SubjectController::class, 'destroy']);



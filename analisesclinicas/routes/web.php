<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExamController;
use App\Models\Patient;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //CEP
    
    Route::get('/getcep/{cep}', [PatientController::class, 'getCep'])->name('cep');

    //Users Routes

    Route::get('/users', [UserController::class, 'index'])->name('user.index');

    Route::get('/new/user', [UserController::class, 'create'])->name('user.create');

    Route::post('/create/new/user', [UserController::class, 'store'])->name('user.store');

    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');

    Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');

    Route::post('/user/search', [UserController::class, 'search'])->name('user.search');


    //Patients Routes

    Route::get('/patients', [PatientController::class, 'index'])->name('patient.index');

    Route::get('/new/patient', [PatientController::class, 'create'])->name('patient.create');

    Route::post('/create/new/patient', [PatientController::class, 'store'])->name('patient.store');

    Route::get('/patient/edit/{id}', [PatientController::class, 'edit'])->name('patient.edit');

    Route::post('/patient/update/{id}', [PatientController::class, 'update'])->name('patient.update');

    Route::post('/patient/search', [PatientController::class, 'search'])->name('patient.search');

    //Exam Routes

    Route::get('/exams', [ExamController::class, 'index'])->name('exam.index');

    Route::get('/new/exam', [ExamController::class, 'create'])->name('exam.create');

    Route::post('/create/new/exam', [ExamController::class, 'store'])->name('exam.store');

    Route::post('/exam/search', [ExamController::class, 'search'])->name('exam.search');

    Route::get('/exam/edit/{id}', [ExamController::class, 'edit'])->name('exam.edit');

    Route::post('/exam/update/{id}', [ExamController::class, 'update'])->name('exam.update');

    //Doctor Routes

    Route::get('/doctors', [DoctorController::class, 'index'])->name('doctor.index');

    Route::get('/new/doctor', [DoctorController::class, 'create'])->name('doctor.create');

    Route::post('/create/new/doctor', [DoctorController::class, 'store'])->name('doctor.store');

    Route::post('/doctor/search', [DoctorController::class, 'search'])->name('doctor.search');

    Route::get('/doctor/edit/{id}', [DoctorController::class, 'edit'])->name('doctor.edit');

    Route::post('/doctor/update/{id}', [DoctorController::class, 'update'])->name('doctor.update');




});

require __DIR__.'/auth.php';

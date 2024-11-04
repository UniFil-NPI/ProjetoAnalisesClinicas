<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamTypeController;
use App\Http\Controllers\PaternityTestController;
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
})->name('welcome');



Route::middleware('auth')->group(function () {

    //Dashboard

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Profile

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //CEP

    Route::get('/getcep/{cep}', [PatientController::class, 'getCep'])->name('cep');

    //Users Routes

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');

        Route::get('/new', [UserController::class, 'create'])->name('create');

        Route::post('/store', [UserController::class, 'store'])->name('store');

        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');

        Route::post('/update/{id}', [UserController::class, 'update'])->name('update');

        Route::post('/search', [UserController::class, 'search'])->name('search');
    });

    //Patients Routes

    Route::prefix('patient')->name('patient.')->group(function () {
        Route::get('/', [PatientController::class, 'index'])->name('index');

        Route::get('/new', [PatientController::class, 'create'])->name('create');

        Route::post('/store', [PatientController::class, 'store'])->name('store');

        Route::get('/edit/{id}', [PatientController::class, 'edit'])->name('edit');

        Route::post('/update/{id}', [PatientController::class, 'update'])->name('update');

        Route::post('/search', [PatientController::class, 'search'])->name('search');
    });

    //Exam Routes
    Route::prefix('exam')->name('exam.')->group(function () {
        Route::get('/', [ExamController::class, 'index'])->name('index');

        Route::get('/new', [ExamController::class, 'create'])->name('create');

        Route::post('/store', [ExamController::class, 'store'])->name('store');

        Route::post('/search', [ExamController::class, 'search'])->name('search');

        Route::get('/edit/{id}', [ExamController::class, 'edit'])->name('edit');

        Route::post('/update/{id}', [ExamController::class, 'update'])->name('update');

        Route::get('/import/{id}', [ExamController::class, 'import_result'])->name('import');

        Route::post('/{id}/store-pdf', [ExamController::class, 'store_pdf_path'])->name('store-pdf');
    });


    //Doctor Routes
    Route::prefix('doctor')->name('doctor.')->group(function () {
        Route::get('/', [DoctorController::class, 'index'])->name('index');

        Route::get('/new', [DoctorController::class, 'create'])->name('create');

        Route::post('/store', [DoctorController::class, 'store'])->name('store');

        Route::post('/search', [DoctorController::class, 'search'])->name('search');

        Route::get('/edit/{id}', [DoctorController::class, 'edit'])->name('edit');

        Route::post('/update/{id}', [DoctorController::class, 'update'])->name('update');
    });


    //Paternity Routes
    Route::prefix('paternitytest')->name('paternity.')->group(function () {

        Route::get('/', [PaternityTestController::class, 'index'])->name('index');

        Route::get('/select', [PaternityTestController::class, 'select'])->name('select');

        Route::get('/new/duo', [PaternityTestController::class, 'create_duo'])->name('create.duo');

        Route::get('/new/trio', [PaternityTestController::class, 'create_trio'])->name('create.trio');

        Route::post('/store', [PaternityTestController::class, 'store'])->name('store');

        Route::post('/search', [PaternityTestController::class, 'search'])->name('search');

        Route::get('/edit/{id}', [PaternityTestController::class, 'edit'])->name('edit');

        Route::post('/update/{id}', [PaternityTestController::class, 'update'])->name('update');

        Route::get('/report/duo/new/{id}', [PaternityTestController::class, 'create_duo_report'])->name('create.duo.report');

        Route::get('/report/trio/new/{id}', [PaternityTestController::class, 'create_trio_report'])->name('create.trio.report');

        Route::post('/report/store/{id}', [PaternityTestController::class, 'store_report'])->name('store.report');

    });

    //Exam Types Routes
    Route::prefix('typeofexam')->name('type.')->group(function () {
            Route::get('/', [ExamTypeController::class, 'index'])->name('index');
        
            Route::get('/new', [ExamTypeController::class, 'create'])->name('create');
        
            Route::post('/store', [ExamTypeController::class, 'store'])->name('store');
        
            Route::post('/search', [ExamTypeController::class, 'search'])->name('search');
        
            Route::get('/edit/{id}', [ExamTypeController::class, 'edit'])->name('edit');
        
            Route::post('/update/{id}', [ExamTypeController::class, 'update'])->name('update');
    });
});

require __DIR__ . '/auth.php';

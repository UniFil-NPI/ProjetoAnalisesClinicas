<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamTypeController;
use App\Http\Controllers\PaternityTestController;
use App\Http\Middleware\EnsureUserHasRole;
use App\Http\Middleware\EnsureUserIsActive;
use App\Models\PaternityTest;
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



Route::middleware('auth', EnsureUserIsActive::class)->group(function () {

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
    })->middleware(EnsureUserHasRole::class.':admin');

    //Patients Routes

    Route::prefix('patient')->name('patient.')->group(function () {
        Route::get('/', [PatientController::class, 'index'])->name('index');

        Route::get('/new', [PatientController::class, 'create'])->name('create');

        Route::post('/store', [PatientController::class, 'store'])->name('store');

        Route::get('/edit/{id}', [PatientController::class, 'edit'])->name('edit');

        Route::post('/update/{id}', [PatientController::class, 'update'])->name('update');

        Route::post('/search', [PatientController::class, 'search'])->name('search');
    })->middleware(EnsureUserHasRole::class.':admin,recepcionist');

    //Exam Routes
    Route::prefix('exam')->name('exam.')->group(function () {
        Route::get('/', [ExamController::class, 'index'])->name('index');

        Route::get('/new', [ExamController::class, 'create'])->name('create')->middleware(EnsureUserHasRole::class.':admin,biomedic,recepcionist');

        Route::post('/store', [ExamController::class, 'store'])->name('store')->middleware(EnsureUserHasRole::class.':admin,biomedic,recepcionist');

        Route::post('/search', [ExamController::class, 'search'])->name('search')->middleware(EnsureUserHasRole::class.':admin,biomedic,recepcionist');

        Route::get('/edit/{id}', [ExamController::class, 'edit'])->name('edit')->middleware(EnsureUserHasRole::class.':admin,biomedic,recepcionist');

        Route::post('/update/{id}', [ExamController::class, 'update'])->name('update')->middleware(EnsureUserHasRole::class.':admin,biomedic,recepcionist');

        Route::get('/report/manage/{id}', [ExamController::class, 'manage_report'])->name('report.manage')->middleware(EnsureUserHasRole::class.':admin,biomedic');

        Route::get('/import/{id}', [ExamController::class, 'import_result'])->name('import')->middleware(EnsureUserHasRole::class.':admin,biomedic');

        Route::get('/report/download/{id}', [ExamController::class, 'download_report'])->name('report.download')->middleware(EnsureUserHasRole::class.':admin,patient,biomedic');

        Route::match(['get', 'post'],'/report/store/import/{id}', [ExamController::class, 'store_import'])->name('store_file')->middleware(EnsureUserHasRole::class.':admin,biomedic');

        Route::post('/report/store/{id}', [ExamController::class, 'store_report'])->name('report.pdf')->middleware(EnsureUserHasRole::class.':admin,biomedic');

        Route::get('/report/remove/{id}', [ExamController::class, 'remove_report'])->name('report.remove')->middleware(EnsureUserHasRole::class.':admin,biomedic');
    });


    //Doctor Routes
    Route::prefix('doctor')->name('doctor.')->group(function () {
        Route::get('/', [DoctorController::class, 'index'])->name('index');

        Route::get('/new', [DoctorController::class, 'create'])->name('create');

        Route::post('/store', [DoctorController::class, 'store'])->name('store');

        Route::post('/search', [DoctorController::class, 'search'])->name('search');

        Route::get('/edit/{id}', [DoctorController::class, 'edit'])->name('edit');

        Route::post('/update/{id}', [DoctorController::class, 'update'])->name('update');
    })->middleware(EnsureUserHasRole::class.':admin,recepcionist');;


    //Paternity Routes
    Route::prefix('paternitytest')->name('paternity.')->group(function () {

        Route::get('/', [PaternityTestController::class, 'index'])->name('index')->middleware(EnsureUserHasRole::class.':admin,patient');

        Route::get('/select', [PaternityTestController::class, 'select'])->name('select')->middleware(EnsureUserHasRole::class.':admin');

        Route::get('/new/duo', [PaternityTestController::class, 'create_duo'])->name('create.duo')->middleware(EnsureUserHasRole::class.':admin');

        Route::get('/new/trio', [PaternityTestController::class, 'create_trio'])->name('create.trio')->middleware(EnsureUserHasRole::class.':admin');

        Route::post('/store/{type}', [PaternityTestController::class, 'store'])->name('store')->middleware(EnsureUserHasRole::class.':admin');

        Route::post('/search', [PaternityTestController::class, 'search'])->name('search')->middleware(EnsureUserHasRole::class.':admin');
        
        Route::get('/edit/{id}', [PaternityTestController::class, 'edit'])->name('edit')->middleware(EnsureUserHasRole::class.':admin');
        
        Route::post('/update/{id}', [PaternityTestController::class, 'update'])->name('update')->middleware(EnsureUserHasRole::class.':admin');
        
        Route::get('/duo/calc/{id}', [PaternityTestController::class, 'calc_ipc_duo'])->name('calc.duo')->middleware(EnsureUserHasRole::class.':admin');
        
        Route::get('/trio/calc/{id}', [PaternityTestController::class, 'calc_ipc_trio'])->name('calc.trio')->middleware(EnsureUserHasRole::class.':admin');
        
        Route::prefix('/report')->name('report.')->group(function() {
            
            Route::get('/manage/{id}', [PaternityTestController::class, 'report_manage'])->name('manage')->middleware(EnsureUserHasRole::class.':admin');

            Route::get('/duo/new/{id}', [PaternityTestController::class, 'create_duo_report'])->name('create.duo')->middleware(EnsureUserHasRole::class.':admin');

            Route::get('/trio/new/{id}', [PaternityTestController::class, 'create_trio_report'])->name('create.trio')->middleware(EnsureUserHasRole::class.':admin');
            
            Route::post('/store/{id}/{type}', [PaternityTestController::class, 'store_report'])->name('store')->middleware(EnsureUserHasRole::class.':admin');

            Route::get('/download/{id}', [PaternityTestController::class, 'download_report'])->name('download')->middleware(EnsureUserHasRole::class.':admin,patient');

            Route::get('/remove/{id}', [PaternityTestController::class, 'remove_report'])->name('remove')->middleware(EnsureUserHasRole::class.':admin');
        });
        

    });

    //Exam Types Routes
    Route::prefix('typeofexam')->name('type.')->group(function () {
            Route::get('/', [ExamTypeController::class, 'index'])->name('index');
        
            Route::get('/new', [ExamTypeController::class, 'create'])->name('create');
        
            Route::post('/store', [ExamTypeController::class, 'store'])->name('store');
        
            Route::post('/search', [ExamTypeController::class, 'search'])->name('search');
        
            Route::get('/edit/{id}', [ExamTypeController::class, 'edit'])->name('edit');
        
            Route::post('/update/{id}', [ExamTypeController::class, 'update'])->name('update');
    })->middleware(EnsureUserHasRole::class.':admin,biomedic');;
});

require __DIR__ . '/auth.php';

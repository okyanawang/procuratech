<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\PelaksanaSampelController;
use App\Http\Controllers\SupervisorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [AuthController::class, 'login_index'])->name('login');
// Add POST method for login
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'register_index']);

Route::group(['prefix' => 'admin', 'as' => 'admin'], function () {
    // Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/', function () {
        return redirect('/admin/dashboard');
    });

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [AdminController::class, 'index'])->name('.dashboard');
    });

    Route::group(['prefix' => 'component'], function () {
        Route::get('/', [AdminController::class, 'component_index'])->name('.component');
    });

    Route::group(['prefix' => 'staff'], function () {
        Route::get('/', [AdminController::class, 'staff_index'])->name('.staff');
        Route::get('/detail', [AdminController::class, 'staff_detail'])->name('.detail');
        Route::get('/register', [AdminController::class, 'staff_register'])->name('.register');
        Route::post('/register', [AuthController::class, 'staff_register_submit'])->name('.register.submit');
    });

    Route::group(['prefix' => 'work'], function () {
        Route::get('/', [AdminController::class, 'work_index'])->name('.work');
    });
});

Route::group(['prefix' => 'pimpinanProject', 'as' => 'pimpinanProject'], function () {
    Route::get('/', function () {
        return redirect('/pimpinanProject/dashboard');
    });

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [PimpinanController::class, 'index'])->name('.dashboard');
    });

    Route::group(['prefix' => 'project'], function () {
        Route::get('/', [PimpinanController::class, 'project_index'])->name('.project');
        Route::get('/detail', [PimpinanController::class, 'project_detail'])->name('.detail');
    });
});

Route::group(['prefix' => 'petugasInventori', 'as' => 'petugasInventori'], function () {
    Route::get('/', function () {
        return redirect('/petugasInventori/dashboard');
    });

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [PetugasController::class, 'index'])->name('.dashboard');
    });

    Route::group(['prefix' => 'component'], function () {
        Route::get('/', [PetugasController::class, 'component_index'])->name('.component');
    });
});

Route::group(['prefix' => 'bendaharaPeralatan', 'as' => 'bendaharaPeralatan'], function () {
    Route::get('/', function () {
        return redirect('/bendaharaPeralatan/dashboard');
    });

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [BendaharaController::class, 'index'])->name('.dashboard');
    });

    Route::group(['prefix' => 'tool'], function () {
        Route::get('/', [BendaharaController::class, 'tool_index'])->name('.tool');
    });
});


Route::group(['prefix' => 'supervisor', 'as' => 'supervisor'], function () {
    Route::get('/', function () {
        return redirect('/supervisor/dashboard');
    });

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [SupervisorController::class, 'index'])->name('.dashboard');
    });

    Route::group(['prefix' => 'project'], function () {
        Route::get('/', [SupervisorController::class, 'project_index'])->name('.project');
    });
});

// Route::resource('pelaksanaSampel', PelaksanaSampelController::class);
// // Pelaksana

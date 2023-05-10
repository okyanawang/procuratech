<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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
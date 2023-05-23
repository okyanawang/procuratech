<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\PelaksanaController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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
Route::get('/login', function () {
    if (Auth::check() && Auth::user()->hasRole('Admin IT')) {
        return redirect('/admin/dashboard');
    } elseif (Auth::check() && Auth::user()->hasRole('Project Manager')) {
        return redirect('/pimpinan/dashboard');
    } elseif (Auth::check() && Auth::user()->hasRole('Job Executor')) {
        return redirect('/petugas/dashboard');
    } elseif (Auth::check() && Auth::user()->hasRole('Job Inspector')) {
        return redirect('/pemeriksa/dashboard');
    } elseif (Auth::check() && Auth::user()->hasRole('Inventory Treasurer')) {
        return redirect('/bendahara/dashboard');
    } elseif (Auth::check() && Auth::user()->hasRole('Measurermant Executor')) {
        return redirect('/pelaksana/dashboard');
    } elseif (Auth::check() && Auth::user()->hasRole('Analyst')) {
        return redirect('/pelaksana_sampel/dashboard');
    } elseif (Auth::check() && Auth::user()->hasRole('Inventory Officer')) {
        return redirect('/inventori/dashboard');
    } elseif (Auth::check() && Auth::user()->hasRole('Supervisor')) {
        return redirect('/supervisor/dashboard');
    }
    return view('auth.login');
})->name('login');

// Route::get('/login', [AuthController::class, 'login_index'])->name('login');
// Add POST method for login
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register_index']);

Route::group(['prefix' => 'admin', 'as' => 'admin', 'middleware' => 'auth.role:Admin IT'], function () {
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
        Route::get('/{id}', [AdminController::class, 'staff_detail'])->name('.detail');
        Route::get('/register', [AdminController::class, 'staff_register'])->name('.register');
        Route::post('/register', [AuthController::class, 'staff_register_submit'])->name('.register.submit');
    });

    Route::group(['prefix' => 'report'], function () {
        Route::get('/', [AdminController::class, 'report_index'])->name('.report');
        Route::get('/detail', [AdminController::class, 'report_detail'])->name('.report_detail');
    });

    Route::group(['prefix' => 'work'], function () {
        Route::get('/', [AdminController::class, 'work_index'])->name('.work');
        Route::get('/{id}', [AdminController::class, 'work_detail'])->name('.work.detail');
        Route::get('/{id}/job', [AdminController::class, 'job_detail'])->name('.job.detail');
    });
});

Route::group(['prefix' => 'pimpinan', 'as' => 'pimpinan', 'middleware' => 'auth.role:Project Manager'], function () {
    Route::get('/', function () {
        return redirect('/pimpinan/dashboard');
    });

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [PimpinanController::class, 'index'])->name('.dashboard');
    });

    Route::group(['prefix' => 'project', 'as' => '.project'], function () {
        Route::get('/', [PimpinanController::class, 'project_index'])->name('.index');
        Route::get('/{id}', [PimpinanController::class, 'project_detail'])->name('.detail');
        // Route::get('/register', [ProjectController::class, 'project_register'])->name('.register');
        Route::post('/register', [ProjectController::class, 'store'])->name('.register.submit');

        Route::group(['prefix' => 'location', 'as' => '.location'], function () {
            // Route::get('/', [PimpinanController::class, 'location_index'])->name('.index');
            Route::get('/{id}', [PimpinanController::class, 'location_detail'])->name('.detail');
            Route::post('/register', [LocationController::class, 'store'])->name('.register.submit');
        });
    });
});

Route::group(['prefix' => 'inventori', 'as' => 'inventori', 'middleware' => 'auth.role:Inventory Officer'], function () {
    Route::get('/', function () {
        return redirect('/inventori/dashboard');
    });

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [PetugasController::class, 'index'])->name('.dashboard');
    });

    Route::group(['prefix' => 'component'], function () {
        Route::get('/', [PetugasController::class, 'component_index'])->name('.component');
    });
});

Route::group(['prefix' => 'bendaharaPeralatan', 'as' => 'bendaharaPeralatan', 'middleware' => 'auth.role:Inventory Treasurer'], function () {
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


Route::group(['prefix' => 'supervisor', 'as' => 'supervisor', 'middleware' => 'auth.role:Supervisor'], function () {
    Route::get('/', function () {
        return redirect('/supervisor/dashboard');
    });

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [SupervisorController::class, 'index'])->name('.dashboard');
    });

    // Route::group(['prefix' => 'project'], function () {
    //     Route::get('/', [SupervisorController::class, 'project_index'])->name('.project');
    // });

    Route::group(['prefix' => 'project'], function () {
        Route::get('/', [SupervisorController::class, 'project_index'])->name('.project');
        Route::get('/{id}', [SupervisorController::class, 'project_detail'])->name('.detail');
        Route::group(['prefix' => 'job'], function () {
            Route::get('/{id}', [SupervisorController::class, 'job_detail'])->name('.jobdetail');
        });
        // Route::get('/detail', [SupervisorController::class, 'project_detail'])->name('.detail');
    });
});

Route::group(['prefix' => 'pengukuran', 'as' => 'pengukuran', 'middleware' => 'auth.role:Measurement Executor'], function () {
    Route::get('/', function () {
        return redirect('/pengukuran/dashboard');
    });

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [PelaksanaController::class, 'index_pengukuran'])->name('.dashboard');
    });

    Route::group(['prefix' => 'tasks'], function () {
        Route::get('/', [PelaksanaController::class, 'index_pengukuran_tasks'])->name('.tasks');
    });
});

// Route::resource('pelaksanaSampel', PelaksanaSampelController::class);
// // Pelaksana

Route::resource('projects', ProjectController::class);
Route::resource('tasks', TaskController::class);

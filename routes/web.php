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
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReportController;
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

    Route::group(['prefix' => 'component', 'as' => '.component'], function () {
        Route::get('/', [AdminController::class, 'component_index'])->name('.index');
        Route::post('/create', [AdminController::class, 'component_store'])->name('.store');
        Route::get('/{id}', [AdminController::class, 'component_detail'])->name('.detail');
        Route::get('/register', [AdminController::class, 'component_register'])->name('.register');
        Route::put('/{id}', [AdminController::class, 'component_update'])->name('.update');
        Route::delete('/{id}', [AdminController::class, 'component_delete'])->name('.delete');
    });

    Route::group(['prefix' => 'staff', 'as' => '.staff'], function () {
        Route::get('/', [AdminController::class, 'staff_index'])->name('.index');
        Route::get('/{id}', [AdminController::class, 'staff_detail'])->name('.detail');
        Route::get('/register', [AdminController::class, 'staff_register'])->name('.register');
        Route::post('/register', [AuthController::class, 'staff_register_submit'])->name('.register.submit');
        Route::put('/{id}', [AdminController::class, 'staff_update'])->name('.update');
        Route::delete('/{id}', [AdminController::class, 'staff_delete'])->name('.delete');
    });

    Route::group(['prefix' => 'report'], function () {
        Route::get('/', [AdminController::class, 'report_index'])->name('.report');
        Route::get('/detail', [AdminController::class, 'report_detail'])->name('.report_detail');
    });

    Route::group(['prefix' => 'work', 'as' => '.work'], function () {
        Route::get('/', [AdminController::class, 'work_index'])->name('.index');
        Route::get('/{id}', [AdminController::class, 'work_detail'])->name('.detail');
        Route::get('/{id}/job', [AdminController::class, 'job_detail'])->name('.job.detail');
        Route::post('/register', [AdminController::class, 'store'])->name('.register');
        Route::post('/job/register', [AdminController::class, 'job_store'])->name('.job.register');
    });

    Route::group(['prefix' => 'project', 'as' => '.project'], function () {
        Route::get('/', [AdminController::class, 'project_index'])->name('.index');
        Route::get('/{id}', [AdminController::class, 'project_detail'])->name('.detail');
        Route::put('/{id}', [AdminController::class, 'project_update'])->name('.update');
        Route::delete('/{id}', [AdminController::class, 'project_delete'])->name('.delete');
        Route::get('/{id}/location', [AdminController::class, 'location_detail'])->name('.location.detail');
        Route::put('/{id}/location', [AdminController::class, 'location_update'])->name('.location.update');
        Route::delete('/{id}/location', [AdminController::class, 'location_delete'])->name('.location.delete');
        Route::get('/{id}/category', [AdminController::class, 'category_detail'])->name('.category.detail');
        Route::put('/{id}/category', [AdminController::class, 'category_update'])->name('.category.update');
        Route::delete('/{id}/category', [AdminController::class, 'category_delete'])->name('.category.delete');
        Route::get('/{id}/task', [AdminController::class, 'task_detail'])->name('.task.detail');
        Route::put('/{id}/task', [AdminController::class, 'task_update'])->name('.task.update');
        Route::delete('/{id}/task', [AdminController::class, 'task_delete'])->name('.task.delete');
        Route::get('/recap/{id}/{user_id}', [AdminController::class, 'task_recap'])->name('.task.recap');
        Route::post('/register', [AdminController::class, 'project_store'])->name('.register');
        Route::post('/location/register', [AdminController::class, 'location_store'])->name('.location.register');
        Route::post('/category/register', [AdminController::class, 'category_store'])->name('.category.register');
        Route::post('/task/register', [TaskController::class, 'store'])->name('.task.register');
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
        Route::put('/{id}', [PimpinanController::class, 'project_update'])->name('.update');
        Route::delete('/{id}', [PimpinanController::class, 'project_delete'])->name('.delete');
        Route::delete('/{id}', [ProjectController::class, 'delete'])->name('.delete');
        // Route::get('/register', [ProjectController::class, 'project_register'])->name('.register');
        Route::post('/register', [ProjectController::class, 'store'])->name('.register.submit');

        Route::group(['prefix' => 'location', 'as' => '.location'], function () {
            // Route::get('/', [PimpinanController::class, 'location_index'])->name('.index');
            Route::get('/{id}', [PimpinanController::class, 'location_detail'])->name('.detail');
            Route::post('/register', [LocationController::class, 'store'])->name('.register.submit');
        });

        Route::group(['prefix' => 'category', 'as' => '.category'], function () {
            // Route::get('/', [PimpinanController::class, 'category_index'])->name('.index');
            Route::get('/{id}', [PimpinanController::class, 'category_detail'])->name('.detail');
            Route::post('/register', [CategoryController::class, 'store'])->name('.register.submit');
            Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('.delete.submit');

            Route::group(['prefix' => 'task', 'as' => '.task'], function () {
                // Route::get('/', [PimpinanController::class, 'task_index'])->name('.index');
                Route::get('/{id}}', [PimpinanController::class, 'task_detail'])->name('.detail');
                // Route::post('/register', [TaskController::class, 'store'])->name('.register.submit');
            });
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

    Route::group(['prefix' => 'item'], function () {
        Route::get('/', [PetugasController::class, 'item_index'])->name('.item');
        Route::get('/{id}', [PetugasController::class, 'item_detail'])->name('.detail');
        Route::get('/register', [PetugasController::class, 'item_register_submit'])->name('.register');
        Route::post('/register', [PetugasController::class, 'item_register_submit'])->name('.register.submit');
        Route::put('/{id}', [PetugasController::class, 'item_update'])->name('.item.update');
        Route::post('/update_stock/{id}/{is_rm}', [PetugasController::class, 'stok_update'])->name('.item.update.stock');
        Route::get('/task_recap/{id}/{item_id}', [PetugasController::class, 'task_recap'])->name('.task.recap');
        // Route::delete('/{id}', [PetugasController::class, 'item_delete'])->name('.delete');
        Route::group(['prefix' => 'delete', 'as' => '.delete'], function () {
            Route::put('/{id}', [PetugasController::class, 'item_delete'])->name('.item');
            // Route::get('/{id}', [PetugasController::class, 'item_delete'])->name('.item');
        });
        // Route::put('/{id}', [PetugasController::class, 'item_delete'])->name('.delete');
    });
});

Route::group(['prefix' => 'supervisor', 'as' => 'supervisor', 'middleware' => 'auth.role:Supervisor'], function () {
    Route::get('/', function () {
        return redirect('/supervisor/dashboard');
    });

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [SupervisorController::class, 'index'])->name('.dashboard');
    });

    Route::group(['prefix' => 'project', 'as' => '.project'], function () {
        Route::get('/', [SupervisorController::class, 'project_index'])->name('.index');
        Route::get('/{id}', [SupervisorController::class, 'project_detail'])->name('.detail');
        Route::group(['prefix' => 'job', 'as' => '.job'], function () {
            Route::post('/register', [TaskController::class, 'store'])->name('.register.submit');
            Route::get('/{id}', [SupervisorController::class, 'job_detail'])->name('.detail');
            Route::put('/update/{id}', [TaskController::class, 'update'])->name('.update');
            Route::delete('/destroy/{id}', [TaskController::class, 'destroy'])->name('.destroy');
            Route::put('/cancel/{id}', [TaskController::class, 'cancel'])->name('.cancel');
            Route::post('/assign_staff/{id}', [TaskController::class, 'assign_staff'])->name('.assign_staff');
            Route::post('/remove_staff/{tasks_id}/{users_id}', [TaskController::class, 'remove_staff'])->name('.remove_staff');
            Route::delete('/tasks/{taskId}/items/{itemId}', [TaskController::class, 'delete_item'])->name('.items_delete');
            Route::post('/add_item/{id}', [TaskController::class, 'add_item'])->name('.add_item');
            Route::put('/update_item/{id}', [TaskController::class, 'update_item'])->name('.update_item');
        });
        // Route::get('/detail', [SupervisorController::class, 'project_detail'])->name('.detail');
    });
});


Route::group(['prefix' => 'pekerja', 'as' => 'pekerja', 'middleware' => 'worker.role'], function () {
    Route::get('/', function () {
        return redirect('/pekerja/dashboard');
    });

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [PelaksanaController::class, 'index_pekerja'])->name('.dashboard');
    });

    Route::group(['prefix' => 'tasks'], function () {
        Route::get('/', [PelaksanaController::class, 'index_pekerja_tasks'])->name('.tasks');
        Route::get('/{id}', [PelaksanaController::class, 'index_pekerja_tasks_detail'])->name('.tasks.detail');
        Route::put('/execute/{id}', [ReportController::class, 'executeTask'])->name('.tasks.execute');
        Route::put('/update/{id}', [ReportController::class, 'update'])->name('.tasks.update');
    });
});

Route::group(['prefix' => 'pemeriksa', 'as' => 'pemeriksa', 'middleware' => 'auth.role:Job Inspector'], function () {
    Route::get('/', function () {
        return redirect('/pemeriksa/dashboard');
    });

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [PelaksanaController::class, 'index_pemeriksa'])->name('.dashboard');
    });

    Route::group(['prefix' => 'tasks'], function () {
        Route::get('/', [PelaksanaController::class, 'index_pemeriksa_tasks'])->name('.tasks');
        Route::get('/{id}', [PelaksanaController::class, 'index_pemeriksa_tasks_detail'])->name('.tasks.detail');
        Route::put('/update_inspect/{id}/{worker_id}', [ReportController::class, 'update_inspect'])->name('.tasks.update_inspect');
        Route::put('/complete/{id}', [TaskController::class, 'completeTask'])->name('.tasks.complete');
    });
});


Route::resource('projects', ProjectController::class);
Route::resource('tasks', TaskController::class);

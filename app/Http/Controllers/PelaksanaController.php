<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Location;
use App\Models\Category;
use App\Models\Task;
use App\Models\Item;
use DB;
use Auth;


class PelaksanaController extends Controller
{
    // pengukuran
    public function index_pengukuran()
    {
        $ntask = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('users_has_tasks.users_id', Auth::user()->id)
            ->select('tasks.*')
            ->count();
        $ongoing_task = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('users_has_tasks.users_id', Auth::user()->id)
            ->where('tasks.status', '=', 'In Progress')
            ->select('tasks.*')
            ->count();

        $done_task = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('users_has_tasks.users_id', Auth::user()->id)
            ->where('tasks.status', '=', 'Completed')
            ->select('tasks.*')
            ->count();
        return view('pelaksana.pengukuran.dashboard',  ['ntask' => $ntask, 'ongoing_task' => $ongoing_task, 'done_task' => $done_task]);
    }

    public function index_pengukuran_tasks()
    {
        $tasks = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('users.id', Auth::user()->id)
            ->select('tasks.id', 'tasks.name as task_name', 'tasks.description as task_description', 'tasks.status as task_status', 'tasks.categories_id as task_categories_id', 'tasks.start_date as task_start', 'tasks.end_date as task_end')
            ->get();
        return view('pelaksana.pengukuran.tasks', ['tasks' => $tasks]);
    }
    public function index_pengukuran_tasks_detail($id)
    {
        $task = Task::find($id);
        // dd($id);
        $project = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->join('locations', 'categories.locations_id', '=', 'locations.id')
            ->join('projects', 'locations.projects_id', '=', 'projects.id')
            ->where('tasks.id', $id)
            ->select('projects.name as project_name', 'projects.description as project_description')
            ->first();
        $location = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->join('locations', 'categories.locations_id', '=', 'locations.id')
            ->where('tasks.id', $id)
            ->select('locations.*')
            ->first();
        $category = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->where('tasks.id', $id)
            ->select('categories.*')
            ->first();
        $pm_ass = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->join('locations', 'categories.locations_id', '=', 'locations.id')
            ->join('projects', 'locations.projects_id', '=', 'projects.id')
            ->join('users_has_projects', 'projects.id', '=', 'users_has_projects.projects_id')
            ->join('users', 'users_has_projects.users_id', '=', 'users.id')
            ->where('tasks.id', $id)
            ->select('users.name', 'users.phone_number', 'users.email as pm_email')
            ->get();
        $spv_ass = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->join('users', 'categories.users_id', '=', 'users.id')
            ->where('tasks.id', $id)
            ->select('users.name', 'users.phone_number')
            ->get();
        $ins_ass = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('tasks.id', $id)
            ->where('users.role', 'Job Inspector')
            ->select('users.name', 'users.phone_number')
            ->get();
        $teams = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('tasks.id', $id)
            ->where('users.role', '<>', 'Job Inspector')
            ->select('users.name', 'users.phone_number', 'users.role')
            ->get();

        return view('pelaksana.pengukuran.tasks-detail', [
            'task' => $task,
            'teams' => $teams,
            'pm_ass' => $pm_ass,
            'spv_ass' => $spv_ass,
            'ins_ass' => $ins_ass,
            'project' => $project,
            'location' => $location,
            'category' => $category,
        ]);
    }

    // analisis
    public function index_analisis()
    {
        $ntask = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('users_has_tasks.users_id', Auth::user()->id)
            ->select('tasks.*')
            ->count();
        $ongoing_task = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('users_has_tasks.users_id', Auth::user()->id)
            ->where('tasks.status', '=', 'In Progress')
            ->select('tasks.*')
            ->count();

        $done_task = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('users_has_tasks.users_id', Auth::user()->id)
            ->where('tasks.status', '=', 'Completed')
            ->select('tasks.*')
            ->count();
        return view('pelaksana.analisis.dashboard', ['ntask' => $ntask, 'ongoing_task' => $ongoing_task, 'done_task' => $done_task]);
    }
    public function index_analisis_tasks()
    {
        $tasks = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('users.id', Auth::user()->id)
            ->select('tasks.id', 'tasks.name as task_name', 'tasks.description as task_description', 'tasks.status as task_status', 'tasks.categories_id as task_categories_id', 'tasks.start_date as task_start', 'tasks.end_date as task_end')
            ->get();
        return view('pelaksana.analisis.tasks', ['tasks' => $tasks]);
        // return view('pelaksana.analisis.tasks');
    }
    public function index_analisis_tasks_detail($id)
    {
        $task = Task::find($id);
        // dd($id);
        $project = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->join('locations', 'categories.locations_id', '=', 'locations.id')
            ->join('projects', 'locations.projects_id', '=', 'projects.id')
            ->where('tasks.id', $id)
            ->select('projects.name as project_name', 'projects.description as project_description', 'projects.image_path as project_image')
            ->first();
        $location = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->join('locations', 'categories.locations_id', '=', 'locations.id')
            ->where('tasks.id', $id)
            ->select('locations.*')
            ->first();
        $category = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->where('tasks.id', $id)
            ->select('categories.*')
            ->first();
        $pm_ass = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->join('locations', 'categories.locations_id', '=', 'locations.id')
            ->join('projects', 'locations.projects_id', '=', 'projects.id')
            ->join('users_has_projects', 'projects.id', '=', 'users_has_projects.projects_id')
            ->join('users', 'users_has_projects.users_id', '=', 'users.id')
            ->where('tasks.id', $id)
            ->select('users.name', 'users.phone_number', 'users.email as pm_email')
            ->get();
        $spv_ass = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->join('users', 'categories.users_id', '=', 'users.id')
            ->where('tasks.id', $id)
            ->select('users.name', 'users.phone_number')
            ->get();
        $ins_ass = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('tasks.id', $id)
            ->where('users.role', 'Job Inspector')
            ->select('users.name', 'users.phone_number')
            ->get();
        $teams = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('tasks.id', $id)
            ->where('users.role', '<>', 'Job Inspector')
            ->select('users.name', 'users.phone_number', 'users.role')
            ->get();
        $reports = DB::table('tasks')
            ->join('reports','tasks.id', '=', 'reports.tasks_id')
            ->where('tasks.id', $id)
            ->select('reports.*')
            ->first();
        // dd($reports);

        return view('pelaksana.analisis.tasks-detail', [
            'task' => $task,
            'teams' => $teams,
            'pm_ass' => $pm_ass,
            'spv_ass' => $spv_ass,
            'ins_ass' => $ins_ass,
            'project' => $project,
            'location' => $location,
            'category' => $category,
            'reports' => $reports
        ]);
    }

    // pekerjaan
    public function index_pekerjaan()
    {
        $ntask = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('users_has_tasks.users_id', Auth::user()->id)
            ->select('tasks.*')
            ->count();
        $ongoing_task = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('users_has_tasks.users_id', Auth::user()->id)
            ->where('tasks.status', '=', 'In Progress')
            ->select('tasks.*')
            ->count();

        $done_task = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('users_has_tasks.users_id', Auth::user()->id)
            ->where('tasks.status', '=', 'Completed')
            ->select('tasks.*')
            ->count();
        return view('pelaksana.pekerjaan.dashboard',  ['ntask' => $ntask, 'ongoing_task' => $ongoing_task, 'done_task' => $done_task]);
    }
    public function index_pekerjaan_tasks()
    {
        $tasks = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('users.id', Auth::user()->id)
            ->select('tasks.id', 'tasks.name as task_name', 'tasks.description as task_description', 'tasks.status as task_status', 'tasks.categories_id as task_categories_id', 'tasks.start_date as task_start', 'tasks.end_date as task_end')
            ->get();
        return view('pelaksana.pekerjaan.tasks', ['tasks' => $tasks]);
    }
    public function index_pekerjaan_tasks_detail($id)
    {
        $task = Task::find($id);
        // dd($id);
        $project = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->join('locations', 'categories.locations_id', '=', 'locations.id')
            ->join('projects', 'locations.projects_id', '=', 'projects.id')
            ->where('tasks.id', $id)
            ->select('projects.name as project_name', 'projects.description as project_description')
            ->first();
        $location = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->join('locations', 'categories.locations_id', '=', 'locations.id')
            ->where('tasks.id', $id)
            ->select('locations.*')
            ->first();
        $category = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->where('tasks.id', $id)
            ->select('categories.*')
            ->first();
        $pm_ass = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->join('locations', 'categories.locations_id', '=', 'locations.id')
            ->join('projects', 'locations.projects_id', '=', 'projects.id')
            ->join('users_has_projects', 'projects.id', '=', 'users_has_projects.projects_id')
            ->join('users', 'users_has_projects.users_id', '=', 'users.id')
            ->where('tasks.id', $id)
            ->select('users.name', 'users.phone_number', 'users.email as pm_email')
            ->get();
        $spv_ass = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->join('users', 'categories.users_id', '=', 'users.id')
            ->where('tasks.id', $id)
            ->select('users.name', 'users.phone_number')
            ->get();
        $ins_ass = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('tasks.id', $id)
            ->where('users.role', 'Job Inspector')
            ->select('users.name', 'users.phone_number')
            ->get();
        $teams = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('tasks.id', $id)
            ->where('users.role', '<>', 'Job Inspector')
            ->select('users.name', 'users.phone_number', 'users.role')
            ->get();
        return view('pelaksana.pekerjaan.tasks-detail', [
            'task' => $task,
            'teams' => $teams,
            'pm_ass' => $pm_ass,
            'spv_ass' => $spv_ass,
            'ins_ass' => $ins_ass,
            'project' => $project,
            'location' => $location,
            'category' => $category,
        ]);
    }

    // pemeriksa
    public function index_pemeriksa()
    {
        $ntask = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('users_has_tasks.users_id', Auth::user()->id)
            ->select('tasks.*')
            ->count();
        $ongoing_task = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('users_has_tasks.users_id', Auth::user()->id)
            ->where('tasks.status', '=', 'In Progress')
            ->select('tasks.*')
            ->count();

        $done_task = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('users_has_tasks.users_id', Auth::user()->id)
            ->where('tasks.status', '=', 'Completed')
            ->select('tasks.*')
            ->count();
        return view('pelaksana.pemeriksa.dashboard',  ['ntask' => $ntask, 'ongoing_task' => $ongoing_task, 'done_task' => $done_task]);
    }
    public function index_pemeriksa_tasks()
    {
        $tasks = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('users.id', Auth::user()->id)
            ->select('tasks.id', 'tasks.name as task_name', 'tasks.description as task_description', 'tasks.status as task_status', 'tasks.categories_id as task_categories_id', 'tasks.start_date as task_start', 'tasks.end_date as task_end')
            ->get();
        return view('pelaksana.pemeriksa.tasks', ['tasks' => $tasks]);
    }
    public function index_pemeriksa_tasks_detail($id)
    {
        $task = Task::find($id);
        // dd($id);
        $project = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->join('locations', 'categories.locations_id', '=', 'locations.id')
            ->join('projects', 'locations.projects_id', '=', 'projects.id')
            ->where('tasks.id', $id)
            ->select('projects.name as project_name', 'projects.description as project_description')
            ->first();
        $location = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->join('locations', 'categories.locations_id', '=', 'locations.id')
            ->where('tasks.id', $id)
            ->select('locations.*')
            ->first();
        $category = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->where('tasks.id', $id)
            ->select('categories.*')
            ->first();
        $pm_ass = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->join('locations', 'categories.locations_id', '=', 'locations.id')
            ->join('projects', 'locations.projects_id', '=', 'projects.id')
            ->join('users_has_projects', 'projects.id', '=', 'users_has_projects.projects_id')
            ->join('users', 'users_has_projects.users_id', '=', 'users.id')
            ->where('tasks.id', $id)
            ->select('users.name', 'users.phone_number', 'users.email as pm_email')
            ->get();
        $spv_ass = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->join('users', 'categories.users_id', '=', 'users.id')
            ->where('tasks.id', $id)
            ->select('users.name', 'users.phone_number')
            ->get();
        $ins_ass = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('tasks.id', $id)
            ->where('users.role', 'Job Inspector')
            ->select('users.name', 'users.phone_number')
            ->get();
        $teams = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('tasks.id', $id)
            ->where('users.role', '<>', 'Job Inspector')
            ->select('users.name', 'users.phone_number', 'users.role')
            ->get();
        $reports = DB::table('tasks')
            ->join('reports', 'tasks.id', '=', 'reports.tasks_id')
            ->join('users', 'reports.users_id', '=', 'users.id')
            ->where('tasks.id', $id)
            ->select('reports.*','users.name')
            ->get();
        return view('pelaksana.pemeriksa.tasks-detail', [
            'task' => $task,
            'teams' => $teams,
            'pm_ass' => $pm_ass,
            'spv_ass' => $spv_ass,
            'ins_ass' => $ins_ass,
            'project' => $project,
            'location' => $location,
            'category' => $category,
            'reports' => $reports,
        ]);
    }
}

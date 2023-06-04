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
    // pekerja
    public function index_pekerja()
    {
        $ntask = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('users_has_tasks.users_id', Auth::user()->id)
            ->select('tasks.*')
            ->count();
        // $ongoing_task = DB::table('tasks')
        //     ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
        //     ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
        //     ->where('users_has_tasks.users_id', Auth::user()->id)
        //     ->where('tasks.status', '=', 'Pending')
        //     ->select('tasks.*')
        //     ->count();
        $ongoing_task = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('reports', 'tasks.id', '=', 'reports.tasks_id')
            ->where('users_has_tasks.users_id', Auth::user()->id)
            ->where('reports.status', '=', 'Pending')
            ->select('reports.*')
            ->count();

        $done_task = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('users_has_tasks.users_id', Auth::user()->id)
            ->where('tasks.status', '=', 'Done')
            ->select('tasks.*')
            ->count();
        return view('pelaksana.pekerja.dashboard', ['ntask' => $ntask, 'ongoing_task' => $ongoing_task, 'done_task' => $done_task]);
    }
    public function index_pekerja_tasks()
    {
        $tasks = DB::table('tasks')
        ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
        ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
        ->leftJoin('reports', function ($join) {
            $join->on('tasks.id', '=', 'reports.tasks_id')
                    ->whereRaw('reports.id = (
                    SELECT MAX(id) FROM reports WHERE tasks_id = tasks.id
                    )');
        })
        ->where('users.id', Auth::user()->id)
        ->select('tasks.id', 'tasks.name as task_name', 'tasks.description as task_description', 'tasks.status as task_status', 'tasks.categories_id as task_categories_id', 'tasks.start_date as task_start', 'tasks.end_date as task_end', 'tasks.image_path as task_image', 'reports.status as rep_status')
        ->get();
        
        // dd($tasks);
        $reports = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->join('reports', 'tasks.id', '=', 'reports.tasks_id')
            ->where('users.id', Auth::user()->id)
            ->select('tasks.id as task_id', 'reports.status as rep_status')
            ->first();
        return view('pelaksana.pekerja.tasks', ['tasks' => $tasks, 'reports' => $reports]);
        // return view('pelaksana.pekerja.tasks');
    }
    public function index_pekerja_tasks_detail($id)
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
        $parts = DB::table('items')
            ->join('tasks_has_items', 'tasks_has_items.items_id', '=', 'items.id')
            ->join('tasks', 'tasks_has_items.tasks_id', '=', 'tasks.id')
            ->where('items.type', 'Parts')
            ->select('items.*', 'tasks_has_items.amount')
            ->distinct()
            ->get();
        $material = DB::table('items')
            ->join('tasks_has_items', 'tasks_has_items.items_id', '=', 'items.id')
            ->join('tasks', 'tasks_has_items.tasks_id', '=', 'tasks.id')
            ->where('items.type', 'Material')
            ->select('items.*', 'tasks_has_items.amount')
            ->distinct()
            ->get();
        $reports = DB::table('tasks')
            ->join('reports', 'tasks.id', '=', 'reports.tasks_id')
            ->where('tasks.id', $id)
            ->where('reports.users_id', Auth::user()->id)
            ->select('reports.*')
            ->orderBy('reports.id', 'DESC')
            ->first();
        $reports_by_user = DB::table('tasks')
            ->join('reports', 'tasks.id', '=', 'reports.tasks_id')
            ->where('tasks.id', $id)
            ->where('reports.users_id', Auth::user()->id)
            ->whereNot('reports.status', "Pending")
            ->whereNot('reports.status', "In Progress")
            ->orderBy('reports.id', 'DESC')
            ->get();
        // dd($parts);

        return view('pelaksana.pekerja.tasks-detail', [
            'task' => $task,
            'teams' => $teams,
            'pm_ass' => $pm_ass,
            'spv_ass' => $spv_ass,
            'ins_ass' => $ins_ass,
            'project' => $project,
            'location' => $location,
            'category' => $category,
            'parts' => $parts,
            'material' => $material,
            'reports' => $reports,
            'reports_by_user' => $reports_by_user
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
            // ->join('reports AS r', 'tasks.id', '=', 'r.tasks_id')
            ->where('users.id', Auth::user()->id)
            ->where('tasks.status', '=', 'Pending')
            #or tasks.status = 'In Progress'
            ->orWhere('tasks.status', '=', 'In Progress')
            ->select('tasks.*')
            ->count();
        // dd($ongoing_task);
        $done_task = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('users_has_tasks.users_id', Auth::user()->id)
            ->where('tasks.status', '=', 'Done')
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
        $tasks = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->leftjoin('reports', 'tasks.id', '=', 'reports.tasks_id')
            ->where('users.id', Auth::user()->id)
            ->select('tasks.id', 'tasks.name as task_name', 'tasks.description as task_description', 'tasks.status as task_status', 'tasks.categories_id as task_categories_id', 'tasks.start_date as task_start', 'tasks.end_date as task_end', 'tasks.image_path as task_image', 'reports.status as rep_status')
            ->get();
        // dd($id);
        $project = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->join('locations', 'categories.locations_id', '=', 'locations.id')
            ->join('projects', 'locations.projects_id', '=', 'projects.id')
            ->where('tasks.id', $id)
            ->select('projects.*')
            ->first();
        // dd($project);
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
        $parts = DB::table('items')
            ->join('tasks_has_items', 'tasks_has_items.items_id', '=', 'items.id')
            ->join('tasks', 'tasks_has_items.tasks_id', '=', 'tasks.id')
            ->where('items.type', 'Parts')
            ->select('items.*', 'tasks_has_items.amount')
            ->distinct()
            ->get();
        $material = DB::table('items')
            ->join('tasks_has_items', 'tasks_has_items.items_id', '=', 'items.id')
            ->join('tasks', 'tasks_has_items.tasks_id', '=', 'tasks.id')
            ->where('items.type', 'Material')
            ->select('items.*', 'tasks_has_items.amount')
            ->distinct()
            ->get();
        $reports = DB::table('tasks')
            ->join('reports', 'tasks.id', '=', 'reports.tasks_id')
            ->join('users', 'reports.users_id', '=', 'users.id')
            ->where('tasks.id', $id)
            // ->where('reports.status', '<>', 'Done')
            ->where('reports.status', '<>', 'Pending')
            ->where('reports.status', '<>', null)
            ->select('reports.*', 'users.id as worker_id', 'users.name')
            ->orderBy('reports.id', 'desc')
            ->get();

        $statuses = DB::table('tasks AS t')
            ->join('users_has_tasks AS uht', 't.id', '=', 'uht.tasks_id')
            ->join('users AS u', 'uht.users_id', '=', 'u.id')
            ->rightJoin('reports AS r', 'uht.users_id', '=', 'r.users_id')
            ->where('t.id', $id)
            ->where('r.status', '=', 'Done')
            ->where('u.role', '<>', 'Job Inspector')
            ->select('u.id', 'r.status', DB::raw('CASE WHEN r.status = "Done" THEN 1 ELSE 0 END AS status_done'))
            ->get();
        // dd($statuses);
        return view('pelaksana.pemeriksa.tasks-detail', [
            'task' => $task,
            'teams' => $teams,
            'pm_ass' => $pm_ass,
            'spv_ass' => $spv_ass,
            'ins_ass' => $ins_ass,
            'project' => $project,
            'location' => $location,
            'category' => $category,
            'parts' => $parts,
            'material' => $material,
            'reports' => $reports,
            'statuses' => $statuses,
        ]);
    }
}

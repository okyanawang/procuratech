<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Task;
use App\Models\User;
use App\Models\ItemLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SupervisorController extends Controller
{
    public function index()
    {
        $nprojects = DB::table('categories')
            ->join('locations', 'categories.locations_id', '=', 'locations.id')
            ->join('projects', 'locations.projects_id', '=', 'projects.id')
            ->where('categories.users_id', Auth::user()->id)
            ->select('projects.*')
            ->count();
        return view('supervisor.dashboard', ['nprojects' => $nprojects]);
    }

    public function project_index()
    {
        $projects = DB::table('projects')
            ->join('locations', 'projects.id', '=', 'locations.projects_id')
            ->join('categories', 'locations.id', '=', 'categories.locations_id')
            ->where('categories.users_id', Auth::user()->id)
            ->select(
                'projects.id as proj_id',
                'locations.id as loc_id',
                'categories.id as cat_id',
                'projects.name as proj_name',
                'locations.name as loc_name',
                'categories.name as cat_name',
                'projects.start_date as start_date',
                'projects.end_date as end_date',
                'projects.status as status'
            )
            ->get();
        // dd($projects);
        return view('supervisor.project', ['projects' => $projects]);
    }

    public function project_detail($id)
    {
        $project = DB::table('projects')
            ->join('locations', 'projects.id', '=', 'locations.projects_id')
            ->join('categories', 'locations.id', '=', 'categories.locations_id')
            ->where('categories.id', $id)
            ->select(
                'projects.id as proj_id',
                'locations.id as loc_id',
                'categories.id as cat_id',
                'projects.name as proj_name',
                'projects.description as proj_desc',
                'projects.image_path as proj_img',
                'projects.project_number as proj_number',
                'locations.name as loc_name',
                'categories.name as cat_name',
                'projects.start_date as start_date',
                'projects.end_date as end_date',
                'projects.status as status'
            )
            ->first();

        // $cat = Category::where('id', $id)->first();
        $tasks = Task::where('categories_id', $id)->get();
        $executor = User::where('role', 'Job Executor')->get();
        $measurer = User::where('role', 'Measurement Executor')->get();
        $analyst = User::where('role', 'Analyst')->get();
        $inspector = User::where('role', 'Job Inspector')->get();

        return view(
            'supervisor.project-detail',
            ['project' => $project, 'tasks' => $tasks, 'executor' => $executor, 'measurer' => $measurer, 'analyst' => $analyst, 'inspector' => $inspector]
        );
    }

    public function job_detail($id)
    {
        $job = Task::where('id', $id)->first();
        $cid = $job->categories_id;
        $pm = DB::table('users')
            ->join('users_has_projects', 'users.id', '=', 'users_has_projects.users_id')
            ->where('users_has_projects.projects_id', $job->categories->locations->projects_id)
            ->where('users.role', 'Project Manager')
            ->select('users.*')
            ->first();
        $measurer_ass = DB::table('users')
            ->join('users_has_tasks', 'users.id', '=', 'users_has_tasks.users_id')
            ->where('users_has_tasks.tasks_id', $id)
            ->where('users.role', 'Measurement Executor')
            ->select('users.*')
            ->get();
        $analyst_ass = DB::table('users')
            ->join('users_has_tasks', 'users.id', '=', 'users_has_tasks.users_id')
            ->where('users_has_tasks.tasks_id', $id)
            ->where('users.role', 'Analyst')
            ->select('users.*')
            ->get();
        $worker_ass = DB::table('users')
            ->join('users_has_tasks', 'users.id', '=', 'users_has_tasks.users_id')
            ->where('users_has_tasks.tasks_id', $id)
            ->where('users.role', 'Job Executor')
            ->select('users.*')
            ->get();
        $inspector_ass = DB::table('users')
            ->join('users_has_tasks', 'users.id', '=', 'users_has_tasks.users_id')
            ->where('users_has_tasks.tasks_id', $id)
            ->where('users.role', 'Job Inspector')
            ->select('users.*')
            ->get();
        $items_ass = DB::table('tasks_has_items')
            ->join('items', 'items.id', '=', 'tasks_has_items.items_id')
            ->where('tasks_has_items.tasks_id', $id)
            ->select('items.*', 'tasks_has_items.amount', 'tasks_has_items.tasks_id as task_id')
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


        $measurer_all = User::where('role', 'Measurement Executor')->get();
        $analyst_all = User::where('role', 'Analyst')->get();
        $worker_all = User::where('role', 'Job Executor')->get();
        $inspector_all = User::where('role', 'Job Inspector')->get();
        $items_all = Item::all();
        $parts_all = Item::where('type', 'Parts')->get();
        $material_all = Item::where('type', 'Material')->get();
        $tool_all = Item::where('type', 'Tool')->get();
        // $itemLogs_all = ItemLog::join('items', 'items.id', '=', 'item_logs.items_id')
        //     ->where('taskName', $job->name)
        //     ->select('item_logs.*', 'items.sku', 'items.unit')
        //     ->get();
        $itemLogs_all = DB::table('item_logs')
            ->join('items', 'items.id', '=', 'item_logs.items_id')
            ->where('item_logs.tasks_id', $job->id)
            ->select('item_logs.*', 'items.name as itemName', 'items.sku', 'items.unit')
            ->get();
        // dd($itemLogs_all);

        return view('supervisor.job-detail', [
            'job' => $job,
            'pm' => $pm,
            'cid' => $cid,
            'reports' => $reports,
            'measurer_ass' => $measurer_ass,
            'analyst_ass' => $analyst_ass,
            'worker_ass' => $worker_ass,
            'inspector_ass' => $inspector_ass,
            'items_ass' => $items_ass,
            'measurer_all' => $measurer_all,
            'analyst_all' => $analyst_all,
            'worker_all' => $worker_all,
            'inspector_all' => $inspector_all,
            'items_all' => $items_all,
            'parts_all' => $parts_all,
            'material_all' => $material_all,
            'tool_all' => $tool_all,
            'itemLogs_all' => $itemLogs_all
        ]);
    }
}

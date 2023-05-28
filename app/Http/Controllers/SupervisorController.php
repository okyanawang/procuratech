<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Auth;

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
            ->select('items.*', 'tasks_has_items.amount')
            ->get();


        $measurer_all = User::where('role', 'Measurement Executor')->get();
        $analyst_all = User::where('role', 'Analyst')->get();
        $worker_all = User::where('role', 'Job Executor')->get();
        $inspector_all = User::where('role', 'Job Inspector')->get();
        $items_all = Item::all();

        return view('supervisor.job-detail', [
            'job' => $job,
            'pm' => $pm,
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
        ]);
    }
}

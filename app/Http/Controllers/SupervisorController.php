<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
            ->select('projects.id as proj_id'
            , 'locations.id as loc_id'
            , 'categories.id as cat_id'
            , 'projects.name as proj_name'
            , 'locations.name as loc_name'
            , 'categories.name as cat_name'
            , 'projects.start_date as start_date'
            , 'projects.end_date as end_date'
            , 'projects.status as status')
            ->get();
        // dd($projects);
        return view('supervisor.project', ['projects' => $projects]);
    }

    public function project_detail($id)
    {
        $cat = Category::where('id', $id)->first();
        $tasks = Task::where('categories_id', $id)->get();
        $executor = User::where('role', 'Job Executor')->get();
        $measurer = User::where('role', 'Measurement Executor')->get();
        $analyst = User::where('role', 'Analyst')->get();
        $inspector = User::where('role', 'Job Inspector')->get();

        return view(
            'supervisor.project-detail',
            ['cat' => $cat, 'tasks' => $tasks, 'executor' => $executor, 'measurer' => $measurer, 'analyst' => $analyst, 'inspector' => $inspector]
        );
    }

    public function job_detail($id)
    {
        $job_detail = DB::table('projects')
            ->join('users_has_projects', 'projects.id', '=', 'users_has_projects.projects_id')
            ->join('users', 'users_has_projects.users_id', '=', 'users.id')
            ->where('projects.id', $id)
            ->select('projects.*')
            ->first();
        return view('supervisor.job-detail', ['job_detail' => $job_detail]);
    }
}

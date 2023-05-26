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
        $nprojects = DB::table('projects')
            ->join('users_has_projects', 'projects.id', '=', 'users_has_projects.projects_id')
            ->join('users', 'users_has_projects.users_id', '=', 'users.id')
            ->where('users_has_projects.users_id', Auth::user()->id)
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
            ->select('categories.id', 'projects.name AS pname', 'locations.name AS lname', 'categories.name AS cname', 'projects.start_date', 'projects.end_date', 'projects.status')
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

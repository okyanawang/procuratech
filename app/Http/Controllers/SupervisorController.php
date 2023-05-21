<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class SupervisorController extends Controller
{
    public function index()
    {
        return view('supervisor.dashboard');
    }

    public function project_index()
    {
        $projects = DB::table('projects')
            ->join('users_has_projects', 'projects.id', '=', 'users_has_projects.projects_id')
            ->join('users', 'users_has_projects.users_id', '=', 'users.id')
            ->where('users_has_projects.users_id', Auth::user()->id)
            ->select('projects.*')
            ->get();
        return view('supervisor.project', ['projects' => $projects]);
    }

    public function project_detail($id)
    {
        $project_detail = DB::table('projects')
            ->join('users_has_projects', 'projects.id', '=', 'users_has_projects.projects_id')
            ->join('users', 'users_has_projects.users_id', '=', 'users.id')
            ->where('projects.id', $id)
            ->select('projects.*')
            ->first();
        $project_has_tasks = DB::table('projects_has_tasks')
            ->join('tasks', 'projects_has_tasks.tasks_id', '=', 'tasks.id')
            ->where('projects_has_tasks.projects_id', $id)
            ->select('tasks.*')
            ->get();
        // dd($project_detail);
        return view('supervisor.project-detail', ['project_detail' => $project_detail, 'project_has_tasks' => $project_has_tasks]);
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

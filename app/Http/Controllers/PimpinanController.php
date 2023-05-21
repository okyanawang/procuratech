<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Project;

class PimpinanController extends Controller
{
    public function index()
    {
        return view('pimpinanProject.dashboard');
    }

    public function project_index()
    {
        $sv = User::where('role', 'Supervisor')->get();
        $projects = DB::table('projects')
            ->join('users_has_projects', 'projects.id', '=', 'users_has_projects.projects_id')
            ->join('users', 'users_has_projects.users_id', '=', 'users.id')
            ->where('users_has_projects.users_id', Auth::user()->id)
            ->select('projects.*')
            ->get();
        // dd($projects);
        // dd($sv);
        return view('pimpinanProject.project', ['sv' => $sv, 'projects' => $projects]);
    }

    public function project_detail($id)
    {
        $project_detail = DB::table('projects')
            ->join('users_has_projects', 'projects.id', '=', 'users_has_projects.projects_id')
            ->join('users', 'users_has_projects.users_id', '=', 'users.id')
            ->where('projects.id', $id)
            ->select('projects.*', 'users.name as sv_name')
            ->first();
        // dd($id);
        // dd($project_detail = Project::find($id));
        return view('pimpinanProject.project-detail', ['project_detail' => $project_detail]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Location;
use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Project;

class PimpinanController extends Controller
{
    public function index()
    {
        $nprojects = DB::table('projects')
            ->join('users_has_projects', 'projects.id', '=', 'users_has_projects.projects_id')
            ->join('users', 'users_has_projects.users_id', '=', 'users.id')
            ->where('users_has_projects.users_id', Auth::user()->id)
            ->select('projects.*')
            ->count();
        return view('pimpinanProject.dashboard', ['nprojects' => $nprojects]);
    }

    public function project_index()
    {
        // $sv = User::where('role', 'Supervisor')->get();
        $projects = DB::table('projects')
            ->join('users_has_projects', 'projects.id', '=', 'users_has_projects.projects_id')
            ->join('users', 'users_has_projects.users_id', '=', 'users.id')
            ->where('users_has_projects.users_id', Auth::user()->id)
            ->select('projects.*')
            ->get();
        // dd($projects);
        // dd($sv);
        return view('pimpinanProject.project', ['projects' => $projects]);
    }

    public function project_detail($id)
    {
        $project_detail = DB::table('projects')
            ->join('users_has_projects', 'projects.id', '=', 'users_has_projects.projects_id')
            ->join('users', 'users_has_projects.users_id', '=', 'users.id')
            ->where('projects.id', $id)
            ->select('projects.*', 'users.name as sv_name')
            ->first();

        $locations = Location::where('projects_id', $id)->get();
        // $tasks_in_project = Task::where('projects_id', $id)->get();
        // dd($id);
        // dd($project_detail = Project::find($id));
        return view('pimpinanProject.project-detail', ['project_detail' => $project_detail, 'locations' => $locations]);
    }

    public function location_detail($id)
    {
        $proj = DB::table('projects')
            ->join('locations', 'projects.id', '=', 'locations.projects_id')
            ->where('locations.id', $id)
            ->select('projects.*')
            ->first();
        $loc = Location::find($id);
        $svs = User::where('role', 'Supervisor')->get();
        // $cats = Category::where('locations_id', $id)->get();
        $cats = DB::table('categories')
            ->join('users', 'categories.users_id', '=', 'users.id')
            ->where('categories.locations_id', $id)
            ->select('categories.*', 'users.name as sv_name')
            ->get();

        return view('pimpinanProject.location-detail', [
            'loc' => $loc,
            'svs' => $svs,
            'cats' => $cats,
            'proj' => $proj,
        ]);
    }

    public function task_detail($id)
    {
        // dd($tasks);
        $task = Task::find($id);
        $category = Category::find($task->categories_id);
        $location = Location::find($category->locations_id);
        $project = Project::find($location->projects_id);

        $sv_on_proj = DB::table('users')
            ->join('categories', 'users.id', '=', 'categories.users_id')
            ->where('categories.id', $category->id)
            ->where('users.role', 'Supervisor')
            ->select('users.*')
            ->first();
        $worker = DB::table('users')
            ->join('users_has_tasks', 'users.id', '=', 'users_has_tasks.users_id')
            ->where('users_has_tasks.tasks_id', $id)
            ->whereNot('users.role', 'Job Inspector')
            ->select('users.*')
            ->get();
        $inspector = DB::table('users')
            ->join('users_has_tasks', 'users.id', '=', 'users_has_tasks.users_id')
            ->where('users_has_tasks.tasks_id', $id)
            ->where('users.role', 'Job Inspector')
            ->select('users.*')
            ->get();

        $parts = DB::table('items')
            ->join('tasks_has_items', 'items.id', '=', 'tasks_has_items.items_id')
            ->where('tasks_has_items.tasks_id', $id)
            ->where('items.type', 'Parts')
            ->select('items.*', 'tasks_has_items.amount')
            ->get();
        $materials = DB::table('items')
            ->join('tasks_has_items', 'items.id', '=', 'tasks_has_items.items_id')
            ->where('tasks_has_items.tasks_id', $id)
            ->where('items.type', 'Material')
            ->select('items.*', 'tasks_has_items.amount')
            ->get();

        return view('pimpinanProject.task-detail', [
            'task' => $task,
            'cat' => $category,
            'loc' => $location,
            'proj' => $project,
            'sv' => $sv_on_proj,
            'worker' => $worker,
            'inspector' => $inspector,
            'parts' => $parts,
            'materials' => $materials,
        ]);
    }
}

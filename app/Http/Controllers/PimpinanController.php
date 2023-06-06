<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ItemLog;
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
            // ->join('locations', 'categories.locations_id', '=', 'locations.id')
            // ->join('projects', 'locations.projects_id', '=', 'projects.id')
            ->join('users_has_projects', 'projects.id', '=', 'users_has_projects.projects_id')
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

        return view('pimpinanProject.project-detail', ['project_detail' => $project_detail, 'locations' => $locations]);
    }

    public function project_update(Request $request, $id)
    {
        $project = Project::find($id);
        $project->name = $request->name;
        $project->status = $request->status;
        $project->description = $request->description;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        if ($request->hasFile('image_path')) {
            $newImageName = time() . '-' . 'projects' . '.' . $request->file('image_path')->extension();
            $request->file('image_path')->move(public_path('project'), $newImageName);
            $project->image_path = $newImageName;
        }
        $project->save();

        return redirect()->route('pimpinan.project.index')->with('success', 'Project updated successfully');
    }

    public function project_delete($id)
    {
        $project = Project::find($id);
        $project->locations()->delete();
        $project->delete();
        return redirect()->route('pimpinan.project.index')->with('success', 'Project deleted successfully');
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
            ->select('categories.*', 'users.name as sv_name', 'users.phone_number as sv_phone')
            ->get();
        // dd($cats);

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
        $tools = DB::table('items')
            ->join('tasks_has_items', 'items.id', '=', 'tasks_has_items.items_id')
            ->where('tasks_has_items.tasks_id', $id)
            ->where('items.type', 'Tool')
            ->select('items.*', 'tasks_has_items.amount')
            ->get();
        $reports = DB::table('tasks')
            ->join('reports', 'tasks.id', '=', 'reports.tasks_id')
            ->join('users', 'reports.users_id', '=', 'users.id')
            ->where('tasks.id', $id)
            ->select('reports.*', 'users.id as worker_id', 'users.name')
            ->orderBy('reports.id', 'desc')
            ->get();

        $itemLogs_all = ItemLog::join('items', 'items.name', '=', 'item_logs.itemName')
            ->where('taskName', $task->name)
            ->select('item_logs.*', 'items.sku', 'items.unit')
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
            'tools' => $tools,
            'reports' => $reports,
            'itemLogs_all' => $itemLogs_all,
        ]);
    }
}

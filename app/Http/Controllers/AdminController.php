<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Location;
use App\Models\Category;
use App\Models\Task;
use App\Models\Item;
use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{
    public function index()
    {
        $nuser = User::where('role', '!=', 'Admin IT')->count();
        return view('admin.dashboard')->with('nuser', $nuser);
    }

    public function component_index()
    {
        $items = Item::all();
        return view('admin.component', ['items' => $items]);
    }

    public function component_detail($id)
    {
        $item = Item::find($id);
        return view('admin.component-detail', ['item' => $item]);
    }

    public function staff_index()
    {
        $staffs = User::where('role', '!=', 'Admmin IT')->get();
        return view('admin.staff', ['staffs' => $staffs]);
    }

    public function staff_detail($id)
    {
        $user = User::find($id);
        $task_user = DB::table('tasks')
                ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
                ->where('users_has_tasks.users_id', $user->id)
                ->select('tasks.*')
                ->get();
        return view('admin.staff-detail', ['user' => $user, 'task_user' => $task_user]);
    }

    public function staff_update(Request $request, $id)
    {
        // dd($request->all());
        $user = User::find($id);
        $user->name = $request->name;
        $user->role = $request->role;
        $user->availability_status = $request->availability_status;
        $user->username = $request->username;
        if($request->password != null)
            $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('admin.staff.index')->with('success', 'Staff berhasil diupdate');
    }

    public function staff_delete($id)
    {
        $user = User::find($id);
        $user->tasks()->detach();
        $user->delete();

        return redirect()->route('admin.staff.index')->with('success', 'Staff berhasil dihapus');
    }

    public function work_index()
    {
        $projects = Project::all();
        return view('admin.work', ['projects' => $projects]);
    }

    public function work_detail($id)
    {
        return view('admin.work-detail');
    }

    public function job_detail($id)
    {
        return view('admin.job-detail');
    }

    public function project_index()
    {
        $projects = Project::all();
        $locations = Location::all();
        $categories = Category::all();
        // butuh jumlah lokasi per project
        // butuh jumlah category per lokasi
        return view('admin.project.project', ['projects' => $projects, 'locations' => $locations, 'categories' => $categories]);
    }

    public function project_detail($id)
    {
        $project = Project::find($id);
        $locations = Location::where('projects_id', $project->id)->get();
        $name_pm = DB::table('users')
                ->join('users_has_projects', 'users.id', '=', 'users_has_projects.users_id')
                ->where('users_has_projects.projects_id', $project->id)
                ->select('users.name')
                ->get();
        $pm_ass = $name_pm->first();
        // butuh jumlah category per lokasi
        return view('admin.project.project-detail', compact('project', 'locations', 'name_pm', 'pm_ass'));
    }

    public function project_update(Request $request, $id)
    {
        $project = Project::find($id);
        $project->name = $request->name;
        $project->description = $request->description;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->save();

        return redirect()->route('admin.project.index')->with('success', 'Project berhasil diupdate');
    }

    public function project_delete($id)
    {
        $project = Project::find($id);
        $project->locations()->delete();
        $project->delete();
        return redirect()->route('admin.project.index')->with('success', 'Project berhasil dihapus');
    }

    public function location_detail($id)
    {
        $location = Location::find($id);
        $project = Project::find($location->projects_id);
        $name_pm = User::find($project->id)->name;
        $categories = Category::where('locations_id', $location->id)->get();
        return view('admin.project.location-detail', compact('project', 'location', 'name_pm', 'categories'));
    }

    public function category_detail($id)
    {
        $category = Category::find($id);
        $location = Location::find($category->locations_id);
        $project = Project::find($location->projects_id);
        $name_pm = User::find($project->id)->name;
        $name_sv = User::find($category->users_id)->name;
        $tasks = Task::where('categories_id', $category->id)->get();
        return view('admin.project.category-detail', compact('project', 'location', 'name_pm', 'category', 'name_sv', 'tasks'));
    }

    public function task_detail($id)
    {
        $task = Task::find($id);
        $category = Category::find($task->categories_id);
        $location = Location::find($category->locations_id);
        $project = Project::find($location->projects_id);
        $name_pm = User::find($project->id)->name;
        $name_sv = User::find($category->users_id)->name;
        // butuh list workers
        $workers = DB::table('tasks')
                ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
                ->join('users', 'users.id', '=', 'users_has_tasks.users_id')
                ->where('tasks_id', $task->id)
                ->select('*')
                ->get();
        // butuh list items
        $items = DB::table('tasks')
                ->join('tasks_has_items', 'tasks.id', '=', 'tasks_has_items.tasks_id')
                ->join('items', 'tasks_has_items.tasks_id', '=', 'items.id')
                ->where('tasks_id', $task->id)
                ->select('*')
                ->get();
        return view('admin.project.task-detail', compact('project', 'location', 'name_pm', 'category', 'name_sv', 'task', 'workers', 'items'));
    }

}

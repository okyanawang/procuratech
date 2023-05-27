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
        return view('admin.component');
    }

    public function staff_index()
    {
        $staffs = User::where('role', '!=', 'Admmin IT')->get();
        return view('admin.staff', ['staffs' => $staffs]);
    }

    public function staff_detail($id)
    {
        $user = User::find($id);
        return view('admin.staff-detail', ['user' => $user]);
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

        return redirect()->route('admin.staff');
    }

    public function staff_delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('admin.staff');
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
        // butuh jumlah lokasi per project
        // butuh jumlah category per lokasi
        return view('admin.project.project', ['projects' => $projects]);
    }

    public function project_detail($id)
    {
        $project = Project::find($id);
        $locations = Location::where('projects_id', $project->id)->get();
        $name_pm = User::find($project->id)->name;
        // butuh jumlah category per lokasi
        return view('admin.project.project-detail', compact('project', 'locations', 'name_pm'));
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
        $workers = 0;
        // butuh list items
        $items = 0;
        return view('admin.project.task-detail', compact('project', 'location', 'name_pm', 'category', 'name_sv', 'task', 'workers', 'items'));
    }
    
}

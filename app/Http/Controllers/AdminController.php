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
use SebastianBergmann\CodeCoverage\Report\Xml\Project as XmlProject;

class AdminController extends Controller
{
    public function index()
    {
        $nuser = User::where('role', '!=', 'Admin IT')->count();
        $nprojects = Project::all()->count();
        $nitems = Item::all()->count();

        return view('admin.dashboard', [
            'nuser' => $nuser,
            'nprojects' => $nprojects,
            'nitems' => $nitems
        ]);
    }

    public function component_index()
    {
        $items = Item::all();
        return view('admin.component', ['items' => $items]);
    }

    public function component_store(Request $request)
    {
        $item = new Item;
        $item->name = $request->name;
        $item->type = $request->type;
        $item->brand = $request->brand;
        $item->produsen = $request->produsen;
        $item->stock = $request->stock;
        $item->unit = $request->unit;
        
        $newImageName = time().'-'.'items'.'.'.$request->file('image_path')->extension();
        $request->file('image_path')->move(public_path('item'), $newImageName);
        $item->image_path = $newImageName;
        $item->save();

        return redirect()->route('admin.component.index')->with('success', 'Component berhasil ditambahkan');
    }

    public function component_detail($id)
    {
        $item = Item::find($id);
        return view('admin.component-detail', ['item' => $item]);
    }

    public function component_update(Request $request, $id)
    {
        $item = Item::find($id);
        $item->name = $request->name;
        $item->type = $request->type;
        $item->brand = $request->brand;
        $item->produsen = $request->produsen;
        $item->stock = $request->stock;
        $item->unit = $request->unit;
        $newImageName = time().'-'.'items'.'.'.$request->file('image_path')->extension();
        $request->file('image_path')->move(public_path('item'), $newImageName);
        $item->image_path = $newImageName;
        
        $item->save();

        return redirect()->route('admin.component.index')->with('success', 'Component berhasil diupdate');
    }

    public function component_delete($id)
    {
        $item = Item::find($id);
        $item->delete();

        return redirect()->route('admin.component.index')->with('success', 'Component berhasil dihapus');
    }

    public function staff_index()
    {
        $staffs = User::where('role', '!=', 'Admin IT')->get();
        return view('admin.staff', ['staffs' => $staffs]);
    }

    public function staff_detail($id)
    {
        $user = User::find($id);
        $task_user = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->where('users_has_tasks.users_id', $user->id)
            ->select('tasks.*')
            ->get()
            ->toArray();
        $cat_user = DB::table('categories')
            ->join('tasks', 'categories.id', '=', 'tasks.categories_id')
            ->where('categories.users_id', $user->id)
            ->select('tasks.*')
            ->get()
            ->toArray();
        $pm_job = DB::table('projects')
            ->join('users_has_projects', 'projects.id', '=', 'users_has_projects.projects_id')
            ->join('locations', 'projects.id', '=', 'locations.projects_id')
            ->join('categories', 'locations.id', '=', 'categories.locations_id')
            ->join('tasks', 'categories.id', '=', 'tasks.categories_id')
            ->where('users_has_projects.users_id', $user->id)
            ->select('tasks.*')
            ->get()
            ->toArray();
        $tasks = array_merge($task_user, $cat_user, $pm_job);
        return view('admin.staff-detail', ['user' => $user, 'task_user' => $task_user, 'tasks' => $tasks]);
    }

    public function staff_update(Request $request, $id)
    {
        // dd($request->all());
        $user = User::find($id);
        $user->name = $request->name;
        $user->role = $request->role;
        $user->availability_status = $request->availability_status;
        $user->username = $request->username;
        if ($request->password != null)
            $user->password = bcrypt($request->password);
            
        $newImageName = time().'-'.'staff'.'.'.$request->file('image_path')->extension();
        $request->file('image_path')->move(public_path('staff'), $newImageName);
        $user->image_path = $newImageName;
        
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

    public function project_store(Request $request)
    {
        $newImageName = time().'-'.'projects'.'.'.$request->file('image_path')->extension();
        $request->file('image_path')->move(public_path('project'), $newImageName);
        $project = new Project;
        $project->name = $request->name;
        $project->registration_date = $request->registration_date;
        $project->description = $request->description;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->status = $request->status;
        $project->image_path = $newImageName;
        
        $project->save();

        return redirect()->route('admin.project.index')->with('success', 'Project berhasil ditambahkan');
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

        if ($name_pm->isEmpty()) {
            $name = "Belum ada PM";
            return view('admin.project.project-detail', compact('project', 'locations', 'name_pm', 'name'));
        }

        $pm_ass = $name_pm->first();
        $name = $pm_ass->name;
        // butuh jumlah category per lokasi
        return view('admin.project.project-detail', compact('project', 'locations', 'name_pm', 'pm_ass', 'name'));
    }

    public function project_update(Request $request, $id)
    {
        $project = Project::find($id);
        $project->name = $request->name;
        $project->description = $request->description;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $newImageName = time().'-'.'projects'.'.'.$request->file('image_path')->extension();
        $request->file('image_path')->move(public_path('project'), $newImageName);
        $project->image_path = $newImageName;
        
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

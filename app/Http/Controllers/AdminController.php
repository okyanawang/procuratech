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
        # count user with admin

        $nuser = User::count();
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
        // $items = Item::all();
        $items = Item::where('stock', '>', '0')->orderBy('name', 'asc')->get();
        return view('admin.component', ['items' => $items]);
    }

    public function component_store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:items|max:255',
            'type' => 'required',
            'brand' => 'required',
            'produsen' => 'required',
            'stock' => 'required|integer',
            'sku' => 'required',
            'unit' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg|max:5048',
        ]);

        $item = new Item;
        $newImageName = time() . '-' . 'items' . '.' . $request->file('image_path')->extension();
        $request->file('image_path')->move(public_path('item'), $newImageName);
        $item->name = $validatedData['name'];
        $item->type = $validatedData['type'];
        $item->brand = $validatedData['brand'];
        $item->produsen = $validatedData['produsen'];
        $item->sku = $validatedData['sku'];
        $item->stock = $validatedData['stock'];
        $item->unit = $validatedData['unit'];
        $item->image_path = $newImageName;
        $item->save();

        return redirect()->back()->with('success', 'Component successfully updated');
    }

    public function component_detail($id)
    {
        $item = Item::find($id);
        $tasks = DB::table('tasks')
            ->join('tasks_has_items', 'tasks.id', '=', 'tasks_has_items.tasks_id')
            ->where('tasks_has_items.items_id', $item->id)
            ->select('tasks.*')
            ->get()
            ->toArray();
        return view('admin.component-detail', ['item' => $item, 'tasks' => $tasks]);
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
        $item->sku = $request->sku;
        if ($request->file('image_path') != null) {
            $newImageName = time() . '-' . 'items' . '.' . $request->file('image_path')->extension();
            $request->file('image_path')->move(public_path('item'), $newImageName);
            $item->image_path = $newImageName;
        }

        $item->save();

        return redirect()->back()->with('success', 'Component successfully updated');
    }

    public function component_delete($id)
    {
        $item = Item::find($id);
        $item->delete();

        return redirect()->route('admin.component.index')->with('success', 'Component successfully deleted');
    }

    public function staff_index()
    {
        $staffs = User::get();
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
        $pm_recap = DB::table('projects')
            ->join('users_has_projects', 'projects.id', '=', 'users_has_projects.projects_id')
            ->where('users_has_projects.users_id', $user->id)
            ->select('projects.*')
            ->get();

        $tasks = array_merge($task_user, $cat_user, $pm_job);
        return view('admin.staff-detail', ['user' => $user, 'task_user' => $task_user, 'tasks' => $tasks, 'cat_user' => $cat_user, 'pm_recap' => $pm_recap]);
    }

    public function staff_update(Request $request, $id)
    {
        // dd($request->all());
        $user = User::find($id);
        $user->name = $request->name;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        // $user->registration_number = $request->registration_number;
        $user->employement_status = $request->employement_status;
        $user->availability_status = $request->availability_status;
        $user->username = $request->username;
        if ($request->password != null)
            $user->password = bcrypt($request->password);

        if ($request->file('image_path') != null) {
            $newImageName = time() . '-' . 'staff' . '.' . $request->file('image_path')->extension();
            $request->file('image_path')->move(public_path('staff'), $newImageName);
            $user->image_path = $newImageName;
        }

        $user->save();

        return redirect()->back()->with('success', 'Staff successfully updated');
    }

    public function staff_delete($id)
    {
        $user = User::find($id);
        $user->tasks()->detach();
        $user->delete();

        return redirect()->route('admin.staff.index')->with('success', 'Staff successfully deleted');
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
        $project = new Project;
        $newImageName = time() . '-' . 'projects' . '.' . $request->file('image_path')->extension();
        $request->file('image_path')->move(public_path('project'), $newImageName);
        $project->name = $request->name;
        $project->registration_date = $request->registration_date;
        $project->description = $request->description;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->status = $request->status;
        $project->image_path = $newImageName;

        $project->save();

        return redirect()->route('admin.project.index')->with('success', 'Project successfully updated');
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
        $project->status = $request->status;
        if ($request->file('image_path') != null) {
            $newImageName = time() . '-' . 'projects' . '.' . $request->file('image_path')->extension();
            $request->file('image_path')->move(public_path('project'), $newImageName);
            $project->image_path = $newImageName;
        }

        $project->save();

        return redirect()->back()->with('success', 'Project successfully updated');
    }

    public function project_delete($id)
    {
        $project = Project::find($id);
        $project->locations()->delete();
        $project->delete();
        return redirect()->route('admin.project.index')->with('success', 'Project successfully deleted');
    }

    public function location_detail($id)
    {
        $location = Location::find($id);
        $project = Project::find($location->projects_id);
        // $name_pm = User::find($project->id)->name;
        $name_pm = User::whereHas('projects', function ($query) use ($project) {
            $query->where('projects.id', $project->id);
        })->first()->name;
        $categories = Category::where('locations_id', $location->id)->get();
        return view('admin.project.location-detail', compact('project', 'location', 'name_pm', 'categories'));
    }

    public function location_delete($id)
    {
        $location = Location::find($id);
        $location->categories()->delete();
        $location->delete();
        return redirect()->route('admin.project.index')->with('success', 'Location successfully deleted');
    }

    public function location_update(Request $request, $id)
    {
        $location = Location::find($id);
        $location->name = $request->name;
        $location->save();

        return redirect()->back()->with('success', 'Location successfully updated');
    }

    public function location_store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'pid' => 'required',
        ]);

        // dd($validatedData);

        $location = new Location;
        $location->name = $validatedData['name'];
        $location->projects_id = $validatedData['pid'];
        $location->save();

        return redirect()->back()->with('success', 'Location added successfully');
    }

    public function category_detail($id)
    {
        $category = Category::find($id);
        $location = Location::find($category->locations_id);
        $project = Project::find($location->projects_id);
        // dd($category->locations_id, $location->projects_id, $category);
        // $name_pm = User::find($project->id)->name;
        $name_pm = User::whereHas('projects', function ($query) use ($project) {
            $query->where('projects.id', $project->id);
        })->first()->name;
        $all_sv = User::where('role', "Supervisor")->get();
        $sv = User::find($category->users_id);

        // dd($sv);

        $tasks = Task::where('categories_id', $category->id)->get();

        return view('admin.project.category-detail', compact('project', 'location', 'name_pm', 'category', 'sv', 'tasks', 'all_sv'));
    }

    public function category_update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();

        return redirect()->back()->with('success', 'Category successfully updated');
    }

    public function category_delete($id)
    {
        $category = Category::find($id);
        $category->tasks()->delete();
        $category->delete();
        return redirect()->route('admin.project.index')->with('success', 'Category successfully deleted');
    }

    public function task_detail($id)
    {
        $task = Task::find($id);
        $category = Category::find($task->categories_id);
        $location = Location::find($category->locations_id);
        $project = Project::find($location->projects_id);
        // $user_id - User::find()
        // $name_pm = User::find($project->id)->name;
        $name_pm = User::whereHas('projects', function ($query) use ($project) {
            $query->where('projects.id', $project->id);
        })->first()->name;
        // dd($name_pm);
        $name_sv = User::find($category->users_id)->name;
        // butuh list workers
        $workers = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('tasks_id', $id)
            ->select('*')
            ->get();
        // dd($workers);
        // butuh list items
        $items = DB::table('tasks')
            ->join('tasks_has_items', 'tasks.id', '=', 'tasks_has_items.tasks_id')
            ->join('items', 'tasks_has_items.items_id', '=', 'items.id')
            ->where('tasks_id', $id)
            ->select('*')
            ->get();
        $reports = DB::table('tasks')
            ->join('reports', 'tasks.id', '=', 'reports.tasks_id')
            ->join('users', 'reports.users_id', '=', 'users.id')
            ->where('tasks.id', $id)
            ->select('reports.*', 'users.id as worker_id', 'users.name')
            ->orderBy('reports.id', 'desc')
            ->get();
        return view('admin.project.task-detail', compact('project', 'location', 'name_pm', 'category', 'name_sv', 'task', 'workers', 'items', 'reports'));
    }

    public function task_recap($id, $user_id)
    {
        $task = Task::find($id);
        $tasks = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->leftjoin('reports', 'tasks.id', '=', 'reports.tasks_id')
            ->where('users.id', $user_id)
            ->select('tasks.id', 'tasks.name as task_name', 'tasks.description as task_description', 'tasks.status as task_status', 'tasks.categories_id as task_categories_id', 'tasks.start_date as task_start', 'tasks.end_date as task_end', 'tasks.image_path as task_image', 'reports.status as rep_status')
            ->get();
        // dd($id);
        $project = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->join('locations', 'categories.locations_id', '=', 'locations.id')
            ->join('projects', 'locations.projects_id', '=', 'projects.id')
            // ->where('tasks.id', $id)
            ->select('projects.*')
            ->first();
        // dd($project);
        $location = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->join('locations', 'categories.locations_id', '=', 'locations.id')
            ->where('tasks.id', $id)
            ->select('locations.*')
            ->first();
        $category = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->where('tasks.id', $id)
            ->select('categories.*')
            ->first();
        $pm_ass = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->join('locations', 'categories.locations_id', '=', 'locations.id')
            ->join('projects', 'locations.projects_id', '=', 'projects.id')
            ->join('users_has_projects', 'projects.id', '=', 'users_has_projects.projects_id')
            ->join('users', 'users_has_projects.users_id', '=', 'users.id')
            ->where('tasks.id', $id)
            ->select('users.name', 'users.phone_number', 'users.email as pm_email')
            ->get();
        $spv_ass = DB::table('tasks')
            ->join('categories', 'tasks.categories_id', '=', 'categories.id')
            ->join('users', 'categories.users_id', '=', 'users.id')
            ->where('tasks.id', $id)
            ->select('users.name', 'users.phone_number')
            ->get();
        $ins_ass = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('tasks.id', $id)
            ->where('users.role', 'Job Inspector')
            ->select('users.name', 'users.phone_number')
            ->get();
        $teams = DB::table('tasks')
            ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
            ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
            ->where('tasks.id', $id)
            ->where('users.role', '<>', 'Job Inspector')
            ->select('users.name', 'users.phone_number', 'users.role')
            ->get();
        $parts = DB::table('items')
            ->join('tasks_has_items', 'tasks_has_items.items_id', '=', 'items.id')
            ->join('tasks', 'tasks_has_items.tasks_id', '=', 'tasks.id')
            ->where('items.type', 'Parts')
            ->where('tasks.id', $id)
            ->select('items.*', 'tasks_has_items.amount')
            ->distinct()
            ->get();
        $material = DB::table('items')
            ->join('tasks_has_items', 'tasks_has_items.items_id', '=', 'items.id')
            ->join('tasks', 'tasks_has_items.tasks_id', '=', 'tasks.id')
            ->where('items.type', 'Material')
            ->where('tasks.id', $id)
            ->select('items.*', 'tasks_has_items.amount')
            ->distinct()
            ->get();
        $tools = DB::table('items')
            ->join('tasks_has_items', 'tasks_has_items.items_id', '=', 'items.id')
            ->join('tasks', 'tasks_has_items.tasks_id', '=', 'tasks.id')
            ->where('items.type', 'Tools')
            ->where('tasks.id', $id)
            ->select('items.*', 'tasks_has_items.amount')
            ->distinct()
            ->get();
        $reports = DB::table('tasks')
            ->join('reports', 'tasks.id', '=', 'reports.tasks_id')
            ->join('users', 'reports.users_id', '=', 'users.id')
            ->where('tasks.id', $id)
            // ->where('reports.status', '<>', 'Done')
            ->where('reports.status', '<>', 'Pending')
            ->where('reports.status', '<>', null)
            ->select('reports.*', 'users.id as worker_id', 'users.name')
            ->orderBy('reports.id', 'desc')
            ->get();

        $statuses = DB::table('tasks AS t')
            ->join('users_has_tasks AS uht', 't.id', '=', 'uht.tasks_id')
            ->join('users AS u', 'uht.users_id', '=', 'u.id')
            ->rightJoin('reports AS r', 'uht.users_id', '=', 'r.users_id')
            ->where('t.id', $id)
            ->where('r.status', '=', 'Done')
            ->where('u.role', '<>', 'Job Inspector')
            ->select('u.id', 'r.status', DB::raw('CASE WHEN r.status = "Done" THEN 1 ELSE 0 END AS status_done'))
            ->get();
        // dd($statuses);
        return view('admin.project.task-recap', [
            'task' => $task,
            'teams' => $teams,
            'pm_ass' => $pm_ass,
            'spv_ass' => $spv_ass,
            'ins_ass' => $ins_ass,
            'project' => $project,
            'location' => $location,
            'category' => $category,
            'parts' => $parts,
            'material' => $material,
            'tools' => $tools,
            'reports' => $reports,
            'statuses' => $statuses,
            'user_id' => $user_id,
        ]);
    }
}

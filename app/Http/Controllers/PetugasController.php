<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Task;
use App\Models\ItemLog;
// import auth
use Illuminate\Support\Facades\Auth;
// import DB
use Illuminate\Support\Facades\DB;

class PetugasController extends Controller
{
    public function index()
    {
        $ncomponents = Item::all()->count();
        return view('petugasInventori.dashboard')->with('ncomponents', $ncomponents);
    }

    public function item_index()
    {
        $nitems = Item::where('stock', '>', '0')->orderBy('name', 'asc')->get();
        return view('petugasInventori.items', ['nitems' => $nitems]);
    }

    public function item_register_submit(Request $request)
    {
        // dd($request->all());
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

        return redirect()->route('inventori.item')->with('success', 'Item added successfully');
    }

    public function item_detail($id)
    {
        $item = Item::find($id);
        $tasks = DB::table('tasks')
            ->join('tasks_has_items', 'tasks.id', '=', 'tasks_has_items.tasks_id')
            ->where('tasks_has_items.items_id', $item->id)
            ->select('tasks.*')
            ->get()
            ->toArray();
        $tasks_name = DB::table('tasks')
            ->join('tasks_has_items', 'tasks.id', '=', 'tasks_has_items.tasks_id')
            ->where('tasks_has_items.items_id', $item->id)
            ->select('tasks.name')
            ->get();
        // ->toArray();

        // $task_name_aa = DB::table('tasks')
        //     ->where('tasks_has_items.items_id', $item->id)
        //     ->select('tasks.name')
        //     ->first();

        // $itemLogs_all = ItemLog::join('items AS i', '')where('items_id', $item->id)
        $itemLogs_all = ItemLog::with(['item', 'task'])->get();
        // dd(json_encode($itemLogs_all));

        foreach ($itemLogs_all as $itemLog) {
            $result = DB::table('tasks_has_items AS thi')
                // ->join('tasks_has_items AS thi', 'il.items_id', '=', 'thi.items_id')
                ->join('tasks AS t', 'thi.tasks_id', '=', 't.id')
                ->join('categories AS c', 't.categories_id', '=', 'c.id')
                ->join('locations AS l', 'c.locations_id', '=', 'l.id')
                ->join('projects AS p', 'l.projects_id', '=', 'p.id')
                // ->where($itemLog->tasks_id, '!=', null)
                ->orWhere('t.id', "=", $itemLog->tasks_id)
                ->where('thi.items_id', '=', $itemLog->items_id)
                ->select('t.name as taskName', 'p.name AS projectName')
                ->first();

            $itemLog['result'] = $result;
        }
        // dd(json_encode($itemLogs_all));
        $itemLogs_sewy = DB::table('item_logs AS il')
                ->leftJoin('tasks AS t', 'il.tasks_id', '=', 't.id')
                ->join('items AS i', 'il.items_id', '=', 'i.id')
                ->leftJoin('categories AS c', 't.categories_id', '=', 'c.id')
                ->leftJoin('locations AS l', 'c.locations_id', '=', 'l.id')
                ->leftJoin('projects AS p', 'l.projects_id', '=', 'p.id')
                ->where('il.items_id', '=', $item->id)
                ->select('il.*', 't.name as task_name', 'p.name AS projectName', 'i.name AS itemName')
                ->get();
        // revision plus where itemName = $item->name and taskName = $tasks_name
        // dd($item);
        return view('petugasInventori.items-detail', compact('item', 'tasks', 'tasks_name', 'itemLogs_all', 'itemLogs_sewy'));
    }

    public function item_edit($id)
    {
        $item = Item::find($id);
        return view('petugasInventori.items-edit', compact('item'));
    }

    public function item_update(Request $request, $id)
    {
        // dd($request->all());
        $item = Item::find($id);
        $item->name = $request->name;
        $item->type = $request->type;
        $item->brand = $request->brand;
        $item->produsen = $request->produsen;
        // $item->stock = $request->stock;
        $item->unit = $request->unit;
        $item->sku = $request->sku;
        // $item->description = $request->description;
        // $newImageName = time() . '-' . 'items' . '.' . $request->file('image_path')->extension();
        if ($request->hasFile('image_path')) {
            $newImageName = time() . '-' . 'items' . '.' . $request->file('image_path')->extension();
            $request->file('image_path')->move(public_path('item'), $newImageName);
            $item->image_path = $newImageName;
        }
        $item->save();

        // Item::whereId($id)->update($validatedData);

        return redirect()->back()->with('success', 'Item updated successfully');
    }

    public function item_delete($id)
    {
        $item = Item::find($id);
        // $item->tasks()->delete();
        $item->stock = 0;
        $item->save();
        // $item->delete();

        return redirect()->route('inventori.item')->with('success', 'Item deleted successfully');
    }

    public function stok_update(Request $request, $id, $is_rm)
    {
        $item = Item::find($id);
        if ($is_rm == 1) {
            $item->stock = $item->stock - $request->stock;
        } else {
            $item->stock = $item->stock + $request->stock;
        }
        // $item->stock = $item->stock + $request->stock;
        $item->save();

        if ($is_rm == 1) {
            $status = "Removed";
        } else {
            $status = "Added";
        }

        ItemLog::create([
            'taskName' => "Updated by Inventory Officer",
            'items_id' => $item->id,
            'status' => $status,
            'stock' => $request->stock,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Stok updated successfully');
    }

    public function task_recap($id, $item_id)
    {
        $task = Task::find($id);
        // $tasks = DB::table('tasks')
        //     ->join('users_has_tasks', 'tasks.id', '=', 'users_has_tasks.tasks_id')
        //     ->join('users', 'users_has_tasks.users_id', '=', 'users.id')
        //     ->leftjoin('reports', 'tasks.id', '=', 'reports.tasks_id')
        //     ->where('users.id', $user_id)
        //     ->select('tasks.id', 'tasks.name as task_name', 'tasks.description as task_description', 'tasks.status as task_status', 'tasks.categories_id as task_categories_id', 'tasks.start_date as task_start', 'tasks.end_date as task_end', 'tasks.image_path as task_image', 'reports.status as rep_status')
        //     ->get();
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
        return view('petugasInventori.task-recap', [
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
            'item_id' => $item_id,
        ]);
    }

    // public function item_detail()
    // {
    //     return view('petugasInventori.items-detail');
    // }
}

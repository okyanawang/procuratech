<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use DB;
// use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        return view('task.index');
    }
    public function create()
    {
        return view('task.create');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|unique:tasks|max:255',
            'description' => 'required',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'categories_id' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg|max:5048',
        ]);

        $newImageName = time() . '-' . 'tasks' . '.' . $request->file('image_path')->extension();
        $request->file('image_path')->move(public_path('task'), $newImageName);

        // dd($validatedData);

        $task = new Task;
        $task->name = $validatedData['name'];
        $task->description = $validatedData['description'];
        $task->type = $validatedData['type'];
        $task->status = "on progress";
        $task->start_date = $validatedData['start_date'];
        $task->end_date = $validatedData['end_date'];
        $task->categories_id = $validatedData['categories_id'];
        $task->image_path = $newImageName;
        $task->save();

        return redirect()->back()->with('success', 'Task berhasil ditambahkan');
    }

    public function assign_staff(Request $request, $id)
    {
        dd($request->all());
        $validatedData = $request->validate([
            'staff' => 'required',
        ]);

        // check if staff already assigned to task
        $check = DB::table('users_has_tasks')
            ->where('users_id', $validatedData['staff'])
            ->where('tasks_id', $id)
            ->count();

        if ($check > 0) {
            // dd($check);
            return redirect()->back()->withErrors('Staff sudah ditambahkan pada task ini');
        }

        // create new users_has_tasks record
        DB::table('users_has_tasks')->insert([
            'users_id' => $validatedData['staff'],
            'tasks_id' => $id,
        ]);

        return redirect()->back()->with('success', 'Staff berhasil ditambahkan');
    }

    public function remove_staff($tasks_id, $users_id)
    {
        // $validatedData = $request->validate([
        //     'staff' => 'required',
        //     'task_id' => 'required',
        // ]);

        // create new users_has_tasks record
        DB::table('users_has_tasks')
            ->where('users_id', $users_id)
            ->where('tasks_id', $tasks_id)
            ->delete();
        // $task->worker = $validatedData['staff'];
        // $task->save();

        return redirect()->back()->with('success', 'Staff berhasil dihapus');
    }

    public function add_item(Request $request, $id)
    {
        $validatedData = $request->validate([
            'item' => 'required',
            'amount' => 'required',
        ]);

        // check if staff already assigned to task
        $check = DB::table('tasks_has_items')
            ->where('items_id', $validatedData['item'])
            ->where('tasks_id', $id)
            ->count();

        if ($check > 0) {
            // dd($check);
            return redirect()->back()->withErrors('Item sudah ditambahkan pada task ini');
        }

        // create new users_has_tasks record
        DB::table('tasks_has_items')->insert([
            'items_id' => $validatedData['item'],
            'tasks_id' => $id,
            'amount' => $validatedData['amount'],
        ]);

        return redirect()->back()->with('success', 'Item berhasil ditambahkan');
    }

    public function show($id)
    {
        $task = Task::find($id);
        return view('task.show', compact('task'));
    }
    public function edit($id)
    {
        $task = Task::find($id);
        return view('task.edit', compact('task'));
    }
    public function update(Request $request, $id)
    {
        // dd($request->all());
        // dd($request->file('image_path'));
        $task = Task::find($id);
        $task->name = $request->name;
        $task->description = $request->description;
        $task->start_date = $request->start_date;
        $task->end_date = $request->end_date;
        $newImageName = time() . '-' . 'tasks' . '.' . $request->file('image_path')->extension();
        $request->file('image_path')->move(public_path('task'), $newImageName);
        $task->image_path = $newImageName;
        $task->save();

        // Task::whereId($id)->update($validatedData);
        return redirect()->back()->with('success', 'Task berhasil diupdate');
    }

    public function delete($id)
    {
        $task = Task::findOrFail($id);
        $task->caetgories()->delete();
        return view('task.delete', compact('task'));
    }

    public function destroy($id)
    {
        $project_id = DB::table('projects')
            ->join('locations', 'locations.projects_id', '=', 'projects.id')
            ->join('categories', 'categories.locations_id', '=', 'locations.id')
            ->join('tasks', 'tasks.categories_id', '=', 'categories.id')
            ->where('tasks.id', $id)
            ->select('projects.id')
            ->first();

        DB::table('users_has_tasks')->where('tasks_id', $id)->delete();
        DB::table('tasks_has_items')->where('tasks_id', $id)->delete();
        $task = Task::findOrFail($id);
        $task->delete();

        if (auth()->user()->role == 'Admin IT')
            return redirect()->route('admin.project.detail', ['id' => $project_id->id])->with('success', 'Task berhasil dihapus');
        else if (auth()->user()->role == 'Supervisor')
            return redirect()->route('supervisor.project.detail', ['id' => $project_id->id])->with('success', 'Task berhasil dihapus');
    }
}

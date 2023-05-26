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
        $validatedData = $request->validate([
            'name' => 'required|unique:tasks|max:255',
            'desc' => 'required',
            'type' => 'required',
            // 'worker' => 'required',
            // 'inspector' => 'required',
            // 'status' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
            'categories_id' => 'required',
        ]);

        // dd($validatedData);

        $task = new Task;
        $task->name = $validatedData['name'];
        $task->description = $validatedData['desc'];
        $task->type = $validatedData['type'];
        $task->status = "on progress";
        $task->start_date = $validatedData['startdate'];
        $task->end_date = $validatedData['enddate'];
        $task->categories_id = $validatedData['categories_id'];
        $task->save();

        return redirect()->route('supervisor.project.index')->with('success', 'Task berhasil ditambahkan');
    }

    public function assign_staff(Request $request)
    {
        $validatedData = $request->validate([
            'staff' => 'required',
            // 'inspector' => 'required',
            'task_id' => 'required',
        ]);

        // create new users_has_tasks record
        DB::table('users_has_tasks')->insert([
            'users_id' => $validatedData['staff'],
            'tasks_id' => $validatedData['task_id'],
        ]);
        // $task->worker = $validatedData['staff'];
        // $task->save();

        return redirect()->route('supervisor.project.job.detail', $validatedData['task_id'])->with('success', 'Staff berhasil ditambahkan');
    }

    public function remove_staff(Request $request)
    {
        $validatedData = $request->validate([
            'staff' => 'required',
            // 'inspector' => 'required',
            'task_id' => 'required',
        ]);

        // create new users_has_tasks record
        DB::table('users_has_tasks')
            ->where('users_id', $validatedData['staff'])
            ->where('tasks_id', $validatedData['task_id'])
            ->delete();
        // $task->worker = $validatedData['staff'];
        // $task->save();

        return redirect()->route('supervisor.project.job.detail', $validatedData['task_id'])->with('success', 'Staff berhasil dihapus');
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
        $validatedData = $request->validate([
            'name' => 'required|unique:tasks|max:255',
            'description' => 'required',
            'type' => 'required',
            'status' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'projects_id' => 'required',
        ]);

        Task::whereId($id)->update($validatedData);
        return redirect()->route('task.index')->with('success', 'Task berhasil diupdate');
    }
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('task.index')->with('success', 'Task berhasil dihapus');
    }
}

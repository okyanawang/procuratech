<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

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
            'description' => 'required',
            'type' => 'required',
            'status' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'projects_id' => 'required',
        ]);

        $task = new Task;
        $task->name = $validatedData['name'];
        $task->description = $validatedData['description'];
        $task->type = $validatedData['type'];
        $task->status = $validatedData['status'];
        $task->start_date = $validatedData['start_date'];
        $task->end_date = $validatedData['end_date'];
        $task->projects_id = $validatedData['projects_id'];
        $task->save();

        return redirect()->route('task.index')->with('success', 'Task berhasil ditambahkan');
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

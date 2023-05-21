<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        return view('project.index');
    }
    public function create()
    {
        return view('project.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:projects|max:255',
            'registration_date' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $project = new Project;
        $project->name = $validatedData['name'];
        $project->registration_date = $validatedData['registration_date'];
        $project->start_date = $validatedData['start_date'];
        $project->end_date = $validatedData['end_date'];
        $project->description = $validatedData['description'];
        $project->status = $validatedData['status'];
        $project->save();

        return redirect()->route('project.index')->with('success', 'Project berhasil ditambahkan');
    }
    public function show($id)
    {
        $project = Project::find($id);
        return view('project.show', compact('project'));
    }
    public function edit($id)
    {
        $project = Project::find($id);
        return view('project.edit', compact('project'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:projects|max:255',
            'registration_date' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        Project::whereId($id)->update($validatedData);

        return redirect()->route('project.index')->with('success', 'Project berhasil diupdate');
    }
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();

        return redirect()->route('project.index')->with('success', 'Project berhasil dihapus');
    }
}

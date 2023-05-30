<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use DB;
use Carbon\Carbon;
use Auth;

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
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|unique:projects|max:255',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required',
            'status' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg|max:5048',
        ]);
        
        $newImageName = time().'-'.'projects'.'.'.$request->file('image_path')->extension();
        $request->file('image_path')->move(public_path('project'), $newImageName);
        // dd($request->newImageName);
        $project = new Project;
        $project->name = $validatedData['name'];
        $project->registration_date = Carbon::now();
        $project->start_date = $validatedData['start_date'];
        $project->end_date = $validatedData['end_date'];
        $project->description = $validatedData['description'];
        $project->status = $validatedData['status'];
        $project->image_path = $newImageName;
        $project->save();
        DB::table('users_has_projects')->insert([
            'users_id' => Auth::user()->id,
            'projects_id' => $project->id,
        ]);

        return redirect()->route('pimpinan.project.index')->with('success', 'Project berhasil ditambahkan');
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
        $project = Project::find($id);
        $project->name = $request->name;
        $project->description = $request->description;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $newImageName = time().'-'.'projects'.'.'.$request->file('image_path')->extension();
        $request->file('image_path')->move(public_path('project'), $newImageName);
        $project->image_path = $newImageName;
        
        $project->save();

        // Project::whereId($id)->update($validatedData);

        return redirect()->route('pimpinan.project.index')->with('success', 'Project berhasil diupdate');
    }

    public function delete($id)
    {
        $project = Project::find($id);
        $project->locations()->delete();
        $project->delete();
        return redirect()->route('pimpinan.project.index')->with('success', 'Project berhasil dihapus');
    }

    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();

        return redirect()->route('project.index')->with('success', 'Project berhasil dihapus');
    }
}

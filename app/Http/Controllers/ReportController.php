<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Report;
use DB;

class ReportController extends Controller
{
    //
    public function executeTask($id)
    {
        // dd($id);
        $reports = new Report;
        $reports->status = 'In Progress';
        $reports->tasks_id = $id;
        $reports->users_id = auth()->user()->id;
        $reports->save();

        return redirect()->back()->with('success', 'Task executed successfully');
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        // dd($request->all());

        $newImageNameWork = time().'-'.'work'.'.'.$request->file('image_path_work')->extension();
        $request->file('image_path_work')->move(public_path('report'), $newImageNameWork);

        // $newImageNameInspect = time().'-'.'inspect'.'.'.$request->file('image_path_inspect')->extension();
        // $request->file('image_path_inspect')->move(public_path('report'), $newImageNameInspect);

        $reports = Report::find($id);
        $reports->description_work = $request->description_work;
        // $reports->description_inspect = $validatedData['description_inspect'];
        // $reports->status = $validatedData['status'];
        $reports->image_path_work = $newImageNameWork;
        $reports->save();

        return redirect()->back()->with('success', 'Report updated successfully');
    }


}

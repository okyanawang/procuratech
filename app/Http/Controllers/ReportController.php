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
        // check if in that task there is a report with status Pending
        $reports = Report::where('tasks_id', $id)->where('users_id', auth()->user()->id)->where('status', 'Pending')->first();
        dd($reports);
        $tasks = Task::find($id);
        // dd($reports);
        if($tasks->status == 'Pending'){
            $tasks->status = 'In Progress';
            $tasks->save();
        }
        if ($reports) {
            $reports->status = 'In Progress';
            $reports->tasks_id = $id;
            $reports->users_id = auth()->user()->id;
            $reports->save();
            // return redirect()->back()->with('error', 'Task already executed');
        } else {

            $reports = new Report;
            $reports->status = 'In Progress';
            $reports->tasks_id = $id;
            $reports->users_id = auth()->user()->id;
            $reports->save();
        }

        return redirect()->back()->with('success', 'Task executed successfully');
    }

    public function update($id, Request $request)
    {
        $newImageNameWork = time() . '-' . 'work' . '.' . $request->file('image_path_work')->extension();
        $request->file('image_path_work')->move(public_path('report'), $newImageNameWork);

        $reports = Report::find($id);
        $reports->description_work = $request->description_work;
        $reports->image_path_work = $newImageNameWork;
        $reports->status = "On Review";
        $reports->save();

        return redirect()->back()->with('success', 'Report updated successfully');
    }

    public function update_inspect($id, $worker_id, Request $request)
    {
        // dd($request->all());
        $newImageNameInspect = time() . '-' . 'inspect' . '.' . $request->file('image_path_inspect')->extension();
        $request->file('image_path_inspect')->move(public_path('report'), $newImageNameInspect);

        $reports = Report::find($id);
        $reports->description_inspect = $request->description_inspect;
        $reports->image_path_inspect = $newImageNameInspect;
        $reports->status = $request->status;
        $reports->save();
        // dd($request->all());
        if ($request->status == 'On Revision') {
            $new_report = new Report;
            $new_report->status = 'Pending';
            $new_report->tasks_id = $reports->tasks_id;
            $new_report->users_id = $worker_id;
            $new_report->save();
        }

        return redirect()->back()->with('success', 'Report updated successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $nuser = User::where('role', '!=', 'Admin IT')->count();
        return view('admin.dashboard')->with('nuser', $nuser);
    }

    public function project_index()
    {
        return view('admin.project');
    }

    public function component_index()
    {
        return view('admin.component');
    }

    public function staff_index()
    {
        $staffs = User::where('role', '!=', 'Admmin IT')->get();
        return view('admin.staff', ['staffs' => $staffs]);
    }

    public function staff_detail($id)
    {
        $user = User::find($id);
        return view('admin.staff-detail', ['user' => $user]);
    }

    public function staff_update(Request $request, $id)
    {
        // dd($request->all());
        $user = User::find($id);
        $user->name = $request->name;
        $user->role = $request->role;
        $user->availability_status = $request->availability_status;
        $user->username = $request->username;
        if($request->password != null)
            $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('admin.staff');
    }

    public function staff_delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('admin.staff');
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

    public function report_index()
    {
        return view('admin.report');
    }

    public function report_detail()
    {
        return view('admin.report-detail');
    }


}

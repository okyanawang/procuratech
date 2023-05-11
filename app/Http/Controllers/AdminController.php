<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
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
    
    // public function staff_index()
    // {
    //     $staffs = User::where('role', '<>', 'admin')->get();
    //     return view('admin.staff', ['staffs' => $staffs]);
    // }

    public function staff_detail()
    {
        return view('admin.staff-detail');
    }

    public function work_index()
    {
        return view('admin.work');
    }
}

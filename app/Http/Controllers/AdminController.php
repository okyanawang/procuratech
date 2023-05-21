<?php

namespace App\Http\Controllers;

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
        return view('admin.staff');
    }

    public function staff_detail()
    {
        return view('admin.staff-detail');
    }

    public function work_index()
    {
        return view('admin.work');
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

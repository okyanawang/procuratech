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

    public function staf_index()
    {
        return view('admin.staf');
    }

    public function staf_detail()
    {
        return view('admin.staf-detail');
    }

    public function work_index()
    {
        return view('admin.work');
    }
}

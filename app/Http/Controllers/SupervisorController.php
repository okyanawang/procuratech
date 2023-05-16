<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function index()
    {
        return view('supervisor.dashboard');
    }

    public function project_index()
    {
        return view('supervisor.project');
    }
}

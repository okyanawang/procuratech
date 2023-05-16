<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PimpinanController extends Controller
{
    public function index()
    {
        return view('pimpinanProject.dashboard');
    }

    public function project_index()
    {
        return view('pimpinanProject.project');
    }

    public function project_detail()
    {
        return view('pimpinanProject.project-detail');
    }
}

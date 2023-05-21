<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PimpinanController extends Controller
{
    public function index()
    {
        return view('pimpinanProject.dashboard');
    }

    public function project_index()
    {
        $sv = User::where('role', 'Supervisor')->get();
        // dd($sv);
        return view('pimpinanProject.project', ['sv' => $sv]);
    }

    public function project_detail()
    {
        return view('pimpinanProject.project-detail');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BendaharaController extends Controller
{
    public function index()
    {
        return view('bendaharaPeralatan.dashboard');
    }

    public function tool_index()
    {
        return view('bendaharaPeralatan.tool');
    }
}

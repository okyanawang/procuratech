<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelaksanaController extends Controller
{
    public function index_pengukuran()
    {
        return view('pelaksana.pengukuran.dashboard');
    }

    public function index_pengukuran_tasks()
    {
        return view('pelaksana.pengukuran.tasks');
    }
}

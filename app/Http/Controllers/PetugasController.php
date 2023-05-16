<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function index()
    {
        return view('petugasInventori.dashboard');
    }

    public function component_index()
    {
        return view('petugasInventori.component');
    }
}

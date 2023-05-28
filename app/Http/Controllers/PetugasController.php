<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function index()
    {
        return view('petugasInventori.dashboard');
    }

    public function item_index()
    {
        return view('petugasInventori.items');
    }

    // public function item_create()
    // {
    //     return view('petugasInventori.item_create');
    // }

    // public function item_edit()
    // {
    //     return view('petugasInventori.item_edit');
    // }

    // public function item_delete()
    // {
    //     return view('petugasInventori.item_delete');
    // }

    public function item_detail()
    {
        return view('petugasInventori.items-detail');
    }
}

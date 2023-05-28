<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelaksanaController extends Controller
{
    // pengukuran
    public function index_pengukuran()
    {
        
        return view('pelaksana.pengukuran.dashboard');
    }

    public function index_pengukuran_tasks()
    {
        return view('pelaksana.pengukuran.tasks');
    }
    public function index_pengukuran_tasks_detail()
    {
        return view('pelaksana.pengukuran.tasks-detail');
    }

    // analisis
    public function index_analisis()
    {
        return view('pelaksana.analisis.dashboard');
    }
    public function index_analisis_tasks()
    {
        return view('pelaksana.analisis.tasks');
    }
    public function index_analisis_tasks_detail()
    {
        return view('pelaksana.analisis.tasks-detail');
    }

    // pekerjaan
    public function index_pekerjaan()
    {
        return view('pelaksana.pekerjaan.dashboard');
    }
    public function index_pekerjaan_tasks()
    {
        return view('pelaksana.pekerjaan.tasks');
    }
    public function index_pekerjaan_tasks_detail()
    {
        return view('pelaksana.pekerjaan.tasks-detail');
    }

    // pemeriksa
    public function index_pemeriksa()
    {
        return view('pelaksana.pemeriksa.dashboard');
    }
    public function index_pemeriksa_tasks()
    {
        return view('pelaksana.pemeriksa.tasks');
    }
    public function index_pemeriksa_tasks_detail()
    {
        return view('pelaksana.pemeriksa.tasks-detail');
    }
}

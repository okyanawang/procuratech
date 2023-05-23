<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'pid' => 'required',
        ]);

        // dd($validatedData);

        $location = new Location;
        $location->name = $validatedData['name'];
        $location->projects_id = $validatedData['pid'];
        $location->save();

        return redirect()->route('pimpinan.project.detail', $validatedData['pid'])->with('success', 'Lokasi berhasil ditambahkan');
    }
}

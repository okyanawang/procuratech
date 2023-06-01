<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Location;
use App\Models\User;
use DB;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'uid' => 'required',
            'lid' => 'required',
        ]);

        // dd($validatedData);

        $category = new Category;
        $category->name = $validatedData['name'];
        $category->users_id = $validatedData['uid'];
        $category->locations_id = $validatedData['lid'];
        $category->save();

        $loc = Location::find($validatedData['lid']);
        $svs = User::where('role', 'Supervisor')->get();
        // $cats = Category::where('locations_id', $id)->get();
        $cats = DB::table('categories')
            ->join('users', 'categories.users_id', '=', 'users.id')
            ->where('categories.locations_id', $validatedData['lid'])
            ->select('categories.*', 'users.name as sv_name')
            ->get();

        return view('pimpinanProject.location-detail', ['loc' => $loc, 'svs' => $svs, 'cats' => $cats])->with('success', 'Categori added successfully');
    }
}

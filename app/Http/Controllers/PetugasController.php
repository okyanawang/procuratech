<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class PetugasController extends Controller
{
    public function index()
    {
        $ncomponents = Item::all()->count();
        return view('petugasInventori.dashboard')->with('ncomponents', $ncomponents);
    }

    public function item_index()
    {
        $nitems = Item::all();
        return view('petugasInventori.items', ['nitems' => $nitems]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:items|max:255',
            'type' => 'required',
            'brand' => 'required',
            'produsen' => 'required',
            'stock' => 'required',
        ]);

        $item = new Item;
        $item->name = $validatedData['name'];
        $item->type = $validatedData['type'];
        $item->brand = $validatedData['brand'];
        $item->produsen = $validatedData['produsen'];
        $item->stock = $validatedData['stock'];
        $item->save();

        DB::table('users_has_items')->insert([
            'users_id' => Auth::user()->id,
            'items_id' => $item->id,
        ]);
        
        return redirect()->route('petugasInventori.items.index')->with('success', 'Item berhasil ditambahkan');
    }

    public function show($id)
    {
        $item = Item::find($id);
        return view('petugasInventori.items-detail', compact('item'));
    }

    public function edit($id)
    {
        $item = Item::find($id);
        return view('petugasInventori.items-edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:items|max:255',
            'type' => 'required',
            'brand' => 'required',
            'produsen' => 'required',
            'stock' => 'required',
            'description' => 'required',
        ]);

        Item::whereId($id)->update($validatedData);

        return redirect()->route('petugasInventori.items.index')->with('success', 'Item berhasil diupdate');
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('petugasInventori.items.index')->with('success', 'Item berhasil dihapus');
    }

    public function item_detail()
    {
        return view('petugasInventori.items-detail');
    }
}

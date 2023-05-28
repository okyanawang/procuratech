<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Task;
// import auth
use Illuminate\Support\Facades\Auth;
// import DB
use DB;

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

    public function item_register_submit(Request $request)
    {
        // dd($request->all());
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

        DB::table('items')->insert([
            'name' => $validatedData['name'],
            'type' => $validatedData['type'],
            'brand' => $validatedData['brand'],
            'produsen' => $validatedData['produsen'],
            'stock' => $validatedData['stock'],
        ]);
        

        return redirect()->route('inventori.item')->with('success', 'Item berhasil ditambahkan');
    }

    public function item_detail($id)
    {
        $item = Item::find($id);
        // dd($item);
        return view('petugasInventori.items-detail', compact('item'));
    }

    public function item_edit($id)
    {
        $item = Item::find($id);
        return view('petugasInventori.items-edit', compact('item'));
    }

    public function item_update(Request $request, $id)
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

        return redirect()->route('inventori.item.detail')->with('success', 'Item berhasil diupdate');
    }

    public function item_delete($id)
    {
        $item = Item::find($id);
        $item->tasks()->detach();
        $item->delete();

        return redirect()->route('inventori.item.index')->with('success', 'Item berhasil dihapus');
    }

    // public function item_detail()
    // {
    //     return view('petugasInventori.items-detail');
    // }
}

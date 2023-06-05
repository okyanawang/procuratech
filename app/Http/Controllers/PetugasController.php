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
            'sku' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg|max:5048',
        ]);


        $item = new Item;
        $newImageName = time() . '-' . 'items' . '.' . $request->file('image_path')->extension();
        $request->file('image_path')->move(public_path('item'), $newImageName);
        $item->name = $validatedData['name'];
        $item->type = $validatedData['type'];
        $item->brand = $validatedData['brand'];
        $item->produsen = $validatedData['produsen'];
        $item->sku = $validatedData['sku'];
        $item->stock = $validatedData['stock'];
        $item->image_path = $newImageName;
        $item->save();

        return redirect()->route('inventori.item')->with('success', 'Item added successfully');
    }

    public function item_detail($id)
    {
        $item = Item::find($id);
        $tasks = DB::table('tasks')
            ->join('tasks_has_items', 'tasks.id', '=', 'tasks_has_items.tasks_id')
            ->where('tasks_has_items.items_id', $item->id)
            ->select('tasks.*')
            ->get()
            ->toArray();
        // dd($item);
        return view('petugasInventori.items-detail', compact('item', 'tasks'));
    }

    public function item_edit($id)
    {
        $item = Item::find($id);
        return view('petugasInventori.items-edit', compact('item'));
    }

    public function item_update(Request $request, $id)
    {
        // dd($request->all());
        $item = Item::find($id);
        $item->name = $request->name;
        $item->type = $request->type;
        $item->brand = $request->brand;
        $item->produsen = $request->produsen;
        $item->stock = $request->stock;
        $item->sku = $request->sku;
        // $item->description = $request->description;
        // $newImageName = time() . '-' . 'items' . '.' . $request->file('image_path')->extension();
        if ($request->hasFile('image_path')) {
            $newImageName = time() . '-' . 'items' . '.' . $request->file('image_path')->extension();
            $request->file('image_path')->move(public_path('item'), $newImageName);
            $item->image_path = $newImageName;
        }
        $item->save();

        // Item::whereId($id)->update($validatedData);

        return redirect()->back()->with('success', 'Item updated successfully');
    }

    public function item_delete($id)
    {
        $item = Item::find($id);
        // $item->tasks()->delete();
        $item->stock = 0;
        $item->save();
        // $item->delete();

        return redirect()->route('inventori.item')->with('success', 'Item deleted successfully');
    }

    // public function item_detail()
    // {
    //     return view('petugasInventori.items-detail');
    // }
}

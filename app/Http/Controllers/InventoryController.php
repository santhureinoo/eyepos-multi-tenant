<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        return response()->view('inventory.index', ['inventories' => Inventory::all()]);
    }

    public function create()
    {
        return response()->view('inventory.create', [
            'categories' => Category::all(),
            'brands'     => Brand::all(),
            'suppliers'  => Supplier::all()
        ]);
    }

    public function store(Request $request)
    {
        $inventory = new Inventory();
        $inventory->fill($request->except(['_token', '_method']));
        $inventory->save();

        // Redirect
        return redirect()->route('inventory.show', $inventory->id)->with('status', 'Inventory Item Successfully Added.');
    }

    public function show($id)
    {
        return view('inventory.show', ['inventory' => Inventory::where('id', $id)->first()]);
    }

    public function edit($id)
    {
        return response()->view('inventory.edit', [
            'inventory'  => Inventory::where('id', $id)->first(),
            'categories' => Category::all(),
            'brands'     => Brand::all(),
            'suppliers'  => Supplier::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $inventory = Inventory::find($id);
        $inventory->fill($request->except(['_token', '_method']));
        $inventory->save();

        // Redirect
        return redirect()->route('inventory.show', $inventory->id)->with('status', 'Inventory Item Successfully Edited.');
    }

    public function destroy($id)
    {
        Inventory::destroy($id);

        // Redirect
        return redirect()->route('inventory')->with('status', 'Inventory Item Successfully Deleted.');
    }
}

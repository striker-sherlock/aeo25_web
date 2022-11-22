<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class InventoryController extends Controller
{
    public function __construct(){
        $this->middleware('IsAdmin');
    }

    public function index()
    {
        return view('inventories.index',[
            'inventories' => Inventory::all(),
        ]);
    }

    public function create()
    {
        return view('inventories.create');
    }

    public function store(Request $request)
    {
       $this->validateInventory($request);

        Inventory::create([
            'borrowed_by' => $request->borrowed_by,
            'borrowed_from' => $request->borrowed_from,
            'item_name' => $request->item_name,
            'qty' => $request->qty,
            'status' => $request->status,
            'location' => $request->location,
            'additional_notes' => $request->input('additional_notes') ,
            'created_by' => 'admin'

        ]);

        return redirect()->route('inventories.index')->with('success','Data Succesfully Inserted');
    }

    public function edit(Inventory $inventory)
    {
        return view('inventories.edit',[ 'inventory' => $inventory]);
    }

    public function update(Request $request, Inventory $inventory)
    {
        $this->validateInventory($request);

        $inventory->update([
            'borrowed_by' => $request->borrowed_by,
            'borrowed_from' => $request->borrowed_from,
            'item_name' => $request->item_name,
            'qty' => $request->qty,
            'status' => $request->status,
            'location' => $request->location,
            'additional_notes' => $request->additional_notes,
            'updated_by' => 'admin',

        ]);

        return redirect()->route('inventories.index')->with('success', 'Data Successfully Updated');

    }
  
    public function destroy(Inventory $inventory)
    {
       $inventory->delete();
       return redirect()->back()->with('success', 'Data Successfully Deleted');

    }

    private function validateInventory(Request $request)
    {
        $request->validate([
            'borrowed_by' => 'required|string',
            'borrowed_from' => 'required|string',
            'item_name' => 'required|string',
            'qty' => 'required|integer',
            'status' => 'required|string',
            'location' => 'required|string',
            'additional_notes' => 'nullable|string',
        ]);
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Countries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CountriesController extends Controller
    {
    public function __construct(){
        $this->middleware('IsShowed:ENV001')->only(['index', 'create']);
    }

    public function index()
    {
        return view('countries.index', [
            'countries' =>Countries::all()
        ]);
    }

   
    public function create()
    {
        return view('countries.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
        ]);
        
        Countries::create([
            'created_by'=>"qwerty",
            'name'=>$request->name,
        ]);
        return redirect()->route('countries.index');// ->with('success','Succesfuly Added');
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit(Countries $country)
    {
        return view('countries.edit', [
            'country'=>$country,
        ]);
    }

   
    public function update(Request $request, Countries $country)
    {
        $request->validate([
            'name'=>'required|string',
        ]);
        
        $country->update([
            'updated_by'=>"asdefg",
            'name'=>$request->name,
        ]);
        return redirect()->route('countries.index');//->with('success','Succesfuly Updated');
    }

   
    public function destroy(Countries $country)
    {
        $country->delete();
        return redirect()->back()->with('success','Succesfuly Deleted');
    }
}

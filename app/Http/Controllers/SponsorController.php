<?php

namespace App\Http\Controllers;

use App\Models\Sponsors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SponsorController extends Controller
{

    public function index()
    {
        return view('sponsors.index',[
            'sponsors' => Sponsors::all(),
        ]);
    }

    public function updateVisibility(Sponsors $sponsor){
        $sponsor->update([
            'is_showed' =>  !$sponsor->is_showed
        ]);
        return redirect()->route('sponsors.index');
    }

    public function create()
    {
        return view('sponsors.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string',
            'logo' => 'required|image|mimes:jpg,jpeg,png|max:1999',
            'is_showed' => 'required'
        ]);

        if ($request->hasFile('logo')){
            $extension  =$request->file("logo")->getClientOriginalExtension();
            $fileName = $request->nama.'.'.$extension;
            $path = $request->file("logo")->storeAs("public/sponsor/logo",$fileName);
        }

        Sponsors::create([
            // 'created_by' => Auth::user()->name,
            'created_by' => 'Admin',
            'name' => $request->nama,
            'logo' => $fileName,
            'is_showed' => $request->is_showed,
        ]);

        return redirect()->route('sponsors.index');
    }

    public function show($id)
    {
        //
    }

    public function edit( Sponsors $sponsor)
    {
        return view('sponsors.edit',[ 
            'sponsor' => $sponsor
        ]);
    }

    public function update(Request $request, Sponsors $sponsor){
        $request->validate([
            'nama' => 'required|string',
            'logo_new' => 'nullable|image|mimes:jpeg,jpg,png|max:1999',
            'logo_old' => 'required|string',
            'is_showed' => 'required'
        ]);
    
        if ($request->hasFile('logo_new')){
            $extension  =$request->file("logo_new")->getClientOriginalExtension();
            $fileName = $request->nama.'.'.$extension;
            $path = $request->file("logo_new")->storeAs("public/sponsor/logo",$fileName);
        }
        else{
            $fileName = $request->logo_old;
        }

        $sponsor->update([
            'name' => $request->nama,
            'logo' => $fileName,
            'is_showed' => $request->is_showed,
        ]);
        return redirect()->route('sponsors.index');
    }

    public function destroy(Sponsors $sponsor)
    {
        $sponsor->delete();
        return redirect()->route('sponsors.index');
    }
}

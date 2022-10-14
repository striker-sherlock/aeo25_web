<?php

namespace App\Http\Controllers;

use App\Models\Sponsors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sponsors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Sponsors $sponsor)
    {
        return view('sponsors.edit',[ 
            'sponsor' => $sponsor
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsors $sponsor)
    {
        $sponsor->delete();
        return redirect()->route('sponsors.index');
    }
}

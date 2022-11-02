<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SponsorController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        return view('sponsors.index',[
            'sponsors' => Sponsor::all(),
        ]);
    }

    public function updateVisibility(Sponsors $sponsor){
        $sponsor->update([
            'updated_by' => 'admin',
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
        $request->validate([
            'nama' => 'required|string',
            'logo' => 'required|image|mimes:jpg,jpeg,png|max:1999',
            'is_showed' => 'required'
        ]);

        // ubah nama file 

        $sponsor= $request->nama;
        $fileName = str_replace(' ', '-', $sponsor);
        $fileName = preg_replace('/[^A-Za-z0-9\-]/', '', $fileName);
        $fileName = str_replace('-', '_', $fileName);
        $current = time();

        if($request->hasFile('logo')){
            $extension = $request->file('logo')->getClientOriginalExtension();
            $file_name = $fileName.'_'.$current.'.'.$extension;
            $path = $request->file("logo")->storeAs("public/sponsor/logo",$fileName);
        }
        

        Sponsor::create([
            // 'created_by' => Auth::user()->name,
            'created_by' => 'Admin',
            'name' => $request->nama,
            'logo' => $file_name,
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
    public function edit( Sponsor $sponsor)
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
            $sponsor= $request->nama;
            $fileName = str_replace(' ', '-', $sponsor);
            $fileName = preg_replace('/[^A-Za-z0-9\-]/', '', $fileName);
            $fileName = str_replace('-', '_', $fileName);
            $current = time();
            $extension = $request->file('logo')->getClientOriginalExtension();
            $file_name = $fileName.'_'.$current.'.'.$extension;
            $path = $request->file("logo")->storeAs("public/sponsor/logo",$fileName);
        }
        else{
            $file_name = $request->logo_old;
        }

        $sponsor->update([
            'updated_by' => 'admin',
            'name' => $request->nama,
            'logo' => $file_name,
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
    public function destroy(Sponsor $sponsor)
    {
        $sponsor->delete();
        return redirect()->route('sponsors.index');
    }
}

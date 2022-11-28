<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompetitionController extends Controller
{
    public function __construct(){
        $this->middleware('IsAdmin');
    }

    public function index()
    {
        return view('competitions.index',[
            'competitions' => Competition::all(),
        ]);
    }

    public function show($id)
    {
        
    }

    public function edit(Competition $competition)
    {
        return view('competitions.edit',[
            'competition' => $competition
        ]);
    }

  
    public function update(Request $request, Competition $competition)
    {
        $request->validate([
            'name'=>'required|string',
            'fixed_quota'=>'required|numeric',
            'temp_quota'=>'required|numeric',
            'price'=>'required|numeric',
            'content'=>'required|string', 
            'logo_new'=>'string',
            'need_submission'=>'required|numeric',
            'need_team'=>'required|numeric',
            'max_people'=>'required|numeric',
        ]);

        $logoName = $request->name;
        $newLogoName = str_replace(' ', '-', $logoName);
        $newLogoName = preg_replace('/[^A-Za-z0-9\-]/', '', $newLogoName);
        $newLogoName = str_replace('-', '_', $newLogoName);
        $current = time();
        if($request->hasFile('logo_new')){
            $extension = $request->file('logo_new')->getClientOriginalExtension();
            $file_name = $newLogoName.'_'.$current.'.'.$extension;
            $path = $request->file('logo_new')->storeAs('public/images/competitions', $file_name);
        }
        else{
            $file_name = $request->logo_old;
        }

        $competition->update([
            'updated_by'=>Auth::user(),
            'name'=>$request->name,
            'fixed_quota'=>$request->fixed_quota,
            'temp_quota'=>$request->temp_quota,
            'price'=>$request->price,
            'content'=>$request->content, 
            'logo'=>$file_name,
            'need_submission'=>$request->need_submission,
            'need_team'=>$request->need_team,
            'max_people'=>$request->max_people,
        ]);

        return redirect()->route('flight-tickets.index');
    }

 
    public function destroy($id)
    {
        //
    }
}

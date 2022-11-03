<?php

namespace App\Http\Controllers;
use App\Models\Accomodations;
use Illuminate\Http\Request;

class AccomodationsController extends Controller
{

    public function index()
    {
        return view('accomodations.index', [
            'accomodations' =>Accomodations::all()
        ]);
    }

    public function create()
    {
        return view('accomodations.create');
    }

    public function store(Request $request)
    {
        dd($request);
        $request->validate([
            'room_type'=>'required|string',
            'max_guests'=>'required|integer',
            'picture'=>'required|string',
        ]);
        
        $name = $request->room_type;
        $newName = str_replace('', '-', $name);
        $newName = preg_replace('/[^A-Za-z0-9\-]/', '', $newName);
        $newName = str_replace('-', '_', $newName);
        $current = time();

        if($request->hasFile('picture')){
            $extension = $request->file('picture')->getClientOriginalExtension();
            $file_name = $newName. '_'. $current. '_picture.' .$extension;
            $path = $request->file('picture')->storeAs('public/images/accomodations', $file_name);
        }

        Accomodations::create([
            'created_by'=>"qwerty",
            'room_type'=>$request->room_type,
            'max_guests'=>$request->max_guests,
            'picture' => $file_name,
        ]);
        return redirect()->route('accomodations.index');// ->with('success','Succesfuly Added');
    }

    public function show($id)
    {
        
    }

    public function edit(Accomodations $accomodation)
    {
        return view('accomodations.edit', [
            'accomodation' => $accomodation,
        ]);
    }

    public function update(Request $request, Accomodations $accomodation)
    {
        $request->validate([
            'room_type'=>'required|string',
            'max_guests'=>'required|int',
            'picture_new'=>'required|string',
        ]);
        
        $name = $request->room_type;
        $newName = str_replace('', '-', $name);
        $newName = preg_replace('/[^A-Za-z0-9\-]/', '', $newName);
        $newName = str_replace('-', '_', $newName);
        $current = time();

        if($request->hasFile('picture_new')){
            $extension = $request->file('picture_new')->getClientOriginalExtension();
            $file_name = $newName. '_'. $current. '_picture.' .$extension;
            $path = $request->file('picture_new')->storeAs('public/images/accomodations', $file_name);
        }
        else{
            $file_name = $request->picture_old;
        }

        $accomodation->update([
            'created_by'=>"qwerty",
            'room_type'=>$request->room_type,
            'max_guests'=>$request->max_guests,
            'picture' => $file_name,
        ]);
        return redirect()->route('accomodations.index');// ->with('success','Succesfuly Added');
    }

    public function destroy(Accomodations $accomodation)
    {
        $accomodation->delete();
        return redirect()->back();
    }
}

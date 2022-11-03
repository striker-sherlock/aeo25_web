<?php

namespace App\Http\Controllers;
use App\Models\Facilities;
use Illuminate\Http\Request;

class FacilitiesController extends Controller
{

    public function index()
    {
        return view('facilities.index', [
            'facilities' => Facilities::all()
        ]);
    }


    public function create()
    {
        return view('facilities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
        ]);
        
        Facilities::create([
            'created_by'=>"qwerty",
            'name'=>$request->name,
        ]);
        return redirect()->route('facilities.index');// ->with('success','Succesfuly Added');
    }

    public function show($id)
    {
        //
    }

    public function edit(Facilities $facility)
    {
        return view('facilities.edit', [
            'facility' => $facility,
        ]);
    }

    public function update(Request $request, Facilities $facility)
    {
        $request->validate([
            'name'=>'required|string',
        ]);
        
        $facility->update([
            'created_by'=>"qwerty",
            'name'=>$request->name,
        ]);
        return redirect()->route('facilities.index');// ->with('success','Succesfuly Added');
    }


    public function destroy(Facilities $facility)
    {
        $facility->delete();
        return redirect()->back();//->with('success','Succesfuly Deleted');    }
    }
}

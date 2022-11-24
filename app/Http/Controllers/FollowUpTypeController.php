<?php

namespace App\Http\Controllers;

use App\Models\FollowUpType;
use Illuminate\Http\Request;

class FollowUpTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('follow-up-types.index',[
            'followUpTypes' => FollowUpType::all(),
        ]);
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('follow-up-types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateFollowUpTypes($request);

        FollowUpType::create([
            'name' => $request->name,
            'created_by' => 'admin'

        ]);

        return redirect()->route('follow-up-types.index')->with('success','Data Succesfully Inserted');

    }


    public function edit(FollowUpType $followUpType)
    {
        return view('follow-up-types.edit',[ 'followUpType' => $followUpType]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FollowUpType $followUpType)
    {
        $this->validateFollowUpTypes($request);

        $followUpType->update([
            'name' => $request->name,   
        ]);

        return redirect()->route('follow-up-types.index')->with('success','Data Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FollowUpType $followUpType)
    {
        $followUpType->delete();
        return redirect()->back()->with('success', 'Data Successfully Deleted');

    }

    protected function validateFollowUpTypes(Request  $request) 
    {
        $request->validate([
            'name' => 'required|string',
        ]);
    }
}

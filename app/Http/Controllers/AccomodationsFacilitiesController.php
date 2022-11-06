<?php

namespace App\Http\Controllers;
use App\Models\AccomodationFacility;
use App\Models\Accomodation;
use App\Models\Facility;
use Illuminate\Http\Request;

class AccomodationsFacilitiesController extends Controller
{

    public function index()
    {
        return view('accomodations-facilities.index', [
            'accomodationFacilities'=>AccomodationFacility::with('accomodation', 'facilities')->get(),
            'accomodations'=>Accomodation::all(),
            'facilities'=>Facility::all(),
        ]);
    }

    public function create()
    {
        return view('accomodations-facilities.create', [
            'accomodations'=>Accomodation::select('room_type')->distinct()->get(),
            'facilities'=>Facility::select('name')->distinct()->get(),
        ]);
    }

    public function store(Request $request)
    {
         //
         $request->validate([
            'is_available'=>'required|string'
        ]);

        $faculty->update([
            'updated_by'=>Auth::user()->nim,
            'faculty_name'=>$request->faculty_name,
            'campus_id'=>$request->campus_id
        ]);
        return redirect()->route('faculties.index');
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

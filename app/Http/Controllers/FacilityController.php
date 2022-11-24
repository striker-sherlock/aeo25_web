<?php

namespace App\Http\Controllers;

use App\Models\AccommodationFacility;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacilityController extends Controller
{
    public function __construct(){
        $this->middleware('IsAdmin');
    }
    
    public function index()
    {
        return view('facilities.index', [
            'facilities' => Facility::all()
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
        
        Facility::create([
            'created_by'=>"qwerty",
            'name'=>$request->name,
        ]);
        return redirect()->route('facilities.index');// ->with('success','Succesfuly Added');
    }

    public function show($id)
    {
        //
    }

    public function edit(Facility $facility)
    {
        return view('facilities.edit', [
            'facility' => $facility,
        ]);
    }

    public function update(Request $request, Facility $facility)
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

    public function destroy(Facility $facility)
    {
        $accommodationFacilities = AccommodationFacility::where('facility_id', $facility->id)->get();

        foreach ($accommodationFacilities as $accommFacility) {
            $accommFacility->delete(); //! Delete semua accommodation facility yg facilitynya mau di delete
        }

        $facility->delete();
        return redirect()->back();//->with('success','Succesfuly Deleted');
    }
}

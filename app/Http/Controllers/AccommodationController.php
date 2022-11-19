<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\AccommodationFacility;
use App\Models\Facility;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    public function index()
    {
        return view('accommodations.index', [
            'accommodations' => Accommodation::all()
        ]);
    }

    public function create()
    {
        return view('accommodations.create', [
            'facilities' => Facility::orderBy('name')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_type'=>'required|string',
            'max_guests'=>'required|integer',
            'picture'=>'required|image',
        ]);
        
        $name = $request->room_type;
        $newName = str_replace('', '-', $name);
        $newName = preg_replace('/[^A-Za-z0-9\-]/', '', $newName);
        $newName = str_replace('-', '_', $newName);
        $current = time();

        if($request->hasFile('picture')){
            $extension = $request->file('picture')->extension();
            $fileName = $newName. '_Room_Picture_'. $current. '.' .$extension;
            $request->file('picture')->storeAs('public/images/accommodations', $fileName);
        }

        $newAccommodation = Accommodation::create([
            'created_by'=>Auth::user()->username,
            'room_type'=>$request->room_type,
            'max_guests'=>$request->max_guests,
            'picture' => $fileName,
        ]);

        foreach (Facility::all() as $facility) {
            AccommodationFacility::create([
                'created_by' => "admin",
                'accommodation_id' => $newAccommodation->id,
                'facility_id' => $facility->id,
                'is_available' => (request($facility->id) ? 1 : 0) //! Ini buat cek kalo Facilitynya di centang berarti true
            ]);
        }
        return redirect()->route('accommodations.index');// ->with('success','Succesfuly Added');
    }

    public function show($id)
    {
        
    }

    public function edit(Accommodation $accommodation)
    {
        return view('accommodations.edit', [
            'accommodation' => $accommodation,
            'accommodationFacilities' => AccommodationFacility::where('accommodation_id', $accommodation->id)->orderBy('is_available', 'DESC')->get(),
            'facilities' => Facility::orderBy('name')->get()
        ]);
    }

    public function update(Request $request, Accommodation $accommodation)
    {
        $request->validate([
            'room_type'=>'required|string',
            'max_guests'=>'required|int',
            'picture_new'=>'nullable|image',
        ]);
        
        $name = $request->room_type;
        $newName = str_replace('', '-', $name);
        $newName = preg_replace('/[^A-Za-z0-9\-]/', '', $newName);
        $newName = str_replace('-', '_', $newName);
        $current = time();

        if($request->hasFile('picture_new')){
            $extension = $request->file('picture_new')->extension();
            $fileName = $newName. '_Room_Picture_'. $current. '.' .$extension;
            $request->file('picture_new')->storeAs('public/images/accommodations', $fileName);
        }
        else{
            $fileName = $request->picture_old;
        }

        $accommodation->update([
            'updated_by'=>"qwerty",
            'room_type'=>$request->room_type,
            'max_guests'=>$request->max_guests,
            'picture' => $fileName,
        ]);

        if($accommodation->facilities->count() > 0) {
            foreach($accommodation->facilities as $accommFacility){
                $accommFacility->update([
                    'updated_by' => 'admin',
                    'is_available' => (request($accommFacility->facility_id) ? 1 : 0)
                ]);
            }
        }else {
            foreach (Facility::all() as $facility) {
                AccommodationFacility::create([
                    'created_by' => "admin",
                    'accommodation_id' => $accommodation->id,
                    'facility_id' => $facility->id,
                    'is_available' => (request($facility->id) ? 1 : 0)
                ]);
            }
        }


        return redirect()->route('accommodations.index');// ->with('success','Succesfuly Added');
    }

    public function destroy(Accommodation $accommodation)
    {
        $accommodationFacilities = AccommodationFacility::where('accommodation_id' , $accommodation->id)->get();

        foreach ($accommodationFacilities as $accommFacility) {
            $accommFacility->delete();
        }

        $accommodation->delete();
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accommodation;
use App\Models\AccommodationGuest;

class AdminAccommodationGuest extends Controller
{
    public function index($roomType = NULL){
        $guests = AccommodationGuest::all();
        if($roomType){
            $guests = AccommodationGuest::join('accommodations','accommodations.id','accommodation_guests.accommodation_id')
                ->where('accommodations.room_type', 'LIKE', $roomType)
                ->select('accommodation_guests.*')
                ->get();
        }

        return view('accommodation-guests.index',[
            'guests' => $guests,
            'accommodations' => Accommodation::all(),
            'roomType' => $roomType 
        ]);
        
    }

    public function edit(AccommodationGuest $accommodationGuest){
        return view('accommodation-guests.edit',[
            'guest'=>$accommodationGuest,
        ]);
    }

    public function update( Request $request,AccommodationGuest  $accommodationGuest){
        $request->validate([
            'guest_name' => 'required|string',
            'gender' => 'required',
        ]);
        
        $accommodationGuest->update([
            'guest_name' => $request->guest_name,
            'guest_gender' => $request->gender,
        ]);

        return redirect()->route('accommodation-guests.index')->with('Guest is successfully updated');
    }
}

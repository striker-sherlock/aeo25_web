<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccommodationSlot;
use App\Models\AccommodationGuest;
use Illuminate\Support\Facades\Auth;

class UserAccommodationGuest extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'verified']);
        $this->middleware('IsShowed:ENV006');
    }
    
    public function create($accommodationSlot){
        $accommodationSlot = AccommodationSlot::find($accommodationSlot);
        // dd($accommodationSlot);  
        
        return view('accommodation-guests.create',[
            'accommodationSlot' => $accommodationSlot
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'guest_name.*' =>'required',   
            'gender.*' =>'required',
        ]);

        $len = count($request->guest_name);
        for($i = 0; $i < $len; $i++){
            AccommodationGuest::create([
                'pic_id' => $request->user_id,
                'accommodation_slot_id' => $request->accommodation_slot_id,
                'accommodation_id' => $request->accommodation_id,
                'guest_name' => $request->guest_name[$i],
                'vaccination_proof' => '-',
                'guest_gender' => $request->gender[$i],
                'created_by' => Auth::user()->username,
            ]);
        }
        return redirect()->route('dashboard')->with('success','Guest is successfully registered');
    }
}

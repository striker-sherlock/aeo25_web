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
            'vaccination_proof.*' =>'required|image|max:2999 '
        ]);

        $len = count($request->guest_name);
        for($i = 0; $i < $len; $i++){
            $vaccination = [];
            dd($request->vaccination_proof);
            if($files = $request->file('vaccination_proof')[$i]){
                $j = 1;
                foreach($files as $file){
                    $newName = $request->guest_name[$i];
                    $newName = str_replace(' ', '-', $newName);
                    $newName = str_replace('/[^A-Za-z0-9\-]/', '', $newName);
                    $newName = str_replace('-', '_', $newName);
                    $current = time();
                    $extension = strtolower($file->extension());
                    $fileName = $newName.'_'.$current.'_'.$j.'.'.$extension;
                    $file->storeAs('public/images/vaccination_proof', $fileName);
                    $vaccination[] = $fileName;
                    $j++;
                }
            }
            AccommodationGuest::create([
                'pic_id' => $request->user_id,
                'accommodation_slot_id' => $request->accommodation_slot_id,
                'accommodation_id' => $request->accommodation_id,
                'guest_name' => $request->guest_name[$i],
                'guest_gender' => $request->gender[$i],
                'vaccination_proof' => implode('; ', $vaccination),
                'created_by' => Auth::user()->username,
            ]);
        }
        return redirect()->route('dashboard')->with('success','Guest is successfully registered');
    }
}

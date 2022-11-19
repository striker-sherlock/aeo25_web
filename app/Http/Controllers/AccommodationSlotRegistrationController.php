<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\AccommodationSlot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class AccommodationSlotRegistrationController extends Controller
{

    public function index()
    {
        
        $pending = AccommodationSlot::where('is_confirmed', 0)->get();
        $confirmed = AccommodationSlot::where('is_confirmed', 1)->get();
        $rejected = AccommodationSlot::where('is_confirmed', -1)->get();
    
        return view('accommodation-slot-registrations.index', [
            'accommodations' => AccommodationSlot::with('accommodation')->get(),
            'pending' => $pending,
            'confirmed' => $confirmed,
            'rejected' => $rejected,
        ]);
    }

    public function create($accommodation = 1 )
    {
        $accommodation = Accommodation::find($accommodation);
        // dd($accommodation);
        return view('accommodation-slot-registrations.create', [
            'accommodations' => Accommodation::all(),
            'selectedType' => $accommodation
        ]);
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'accommodation_id'=>'required', 
            'check_in_date'=>'required',
            'check_out_date'=>'required|after:check_in_date',
            'special_req'=>'required',
            'quantity'=>'required',
            
        ]);
        dd($request->all());

        AccommodationSlot::create([
            'created_by' => Auth::user()->username,
            'pic_id' => Auth::user()->id,
            // 'created_at' => Carbon::now(),
            'accommodation_id' => $request->accommodation_id,
            'check_in_date'=>$request->check_in_date,
            'check_out_date'=>$request->check_out_date,
            'special_req'=>$request->special_req,
            'quantity' => $request->quantity,
            'is_confirmed' => 0,
        ]);
        return redirect()->route('accommodation-slot-registrations.index');
    }


    public function show($id)
    {
        //
    }

 
    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function confirm(AccommodationSlot $accommodationSlot){
        $accommodationSlot ->update([
            'updated_by' => 'Admin',
            'is_confirmed' => 1,
        ]);
        return redirect()->route('accommodation-slot-registrations.index');
    }

    public function cancel (AccommodationSlot $accommodationSlot){
        $accommodationSlot ->update([
            'updated_by' => 'Admin',
            'is_confirmed' => 0
        ]);
        return redirect()->route('accommodation-slot-registrations.index');
    }
    public function reject ( AccommodationSlot $accommodationSlot){
       
        $accommodationSlot ->update([
            'updated_by' => 'Admin',
            'is_confirmed' => -1
        ]);
        return redirect()->route('accommodation-slot-registrations.index');
    }
}

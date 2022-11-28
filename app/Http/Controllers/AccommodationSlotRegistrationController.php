<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\AccommodationSlot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Arr;
use App\Mail\RejectionMail;
use Illuminate\Http\Request;
use App\Mail\ConfirmedSlotMail;
use Carbon\Carbon;

class AccommodationSlotRegistrationController extends Controller
{
    public function __construct(){
        $this->middleware('IsShowed:ENV010');   
        $this->middleware('IsAdmin');
        $this->middleware('auth', ['verified'])->only(['create']);
    }

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
            'special_req'=>'nullable|string',
            'quantity'=>'required',
        ]);

        AccommodationSlot::create([
            'created_by' => Auth::user()->username,
            'pic_id' => Auth::user()->id,
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

    public function edit(AccommodationSlot $accommodation_slot_registration)
    {
        return view('accommodation-slot-registrations.edit', [
            'accommodationSlot' => $accommodation_slot_registration,
            'accommodations' => Accommodation::all(),
        ]);
    }


    public function update(Request $request, AccommodationSlot $accommodation_slot_registration)
    {
        // dd($request);
        $request->validate([
            'accommodation_id'=>'required', 
            'check_in_date'=>'required',
            'check_out_date'=>'required',
            'special_req'=>'required',
            'quantity'=>'required',
        ]);

        $accommodation_slot_registration->update([
            'created_by' => Auth::user()->username,
            'pic_id' => Auth::user()->id,
            'accommodation_id' => $request->accommodation_id,
            'check_in_date'=>$request->check_in_date,
            'check_out_date'=>$request->check_out_date,
            'special_req'=>$request->special_req,
            'quantity' => $request->quantity,
        ]);
        if(!Auth::guard('admin')->check()){
            return redirect()->route('dashboard.accommodation-step',1)->with('success', "Accommodation registration successfully updated!");
        }
        else{
            return redirect()->route('accommodation-slot-registrations.index')->with('success', "Accommodation registration successfully updated!");
        }
    }


    public function destroy(AccommodationSlot $accommodationSlot)
    {
        $accommodationSlot->delete();
        return redirect()->back();
    }

    public function confirm(AccommodationSlot $accommodationSlot){
        $accommodationSlot ->update([
            'updated_by' => 'Admin',
            'is_confirmed' => 1,
            'confirmed_at' => Carbon::now(),
        ]);
        $confirmedMail = [
            'subject' => $accommodationSlot->accommodation->room_type. " - Confirmed Slot",
            'name'=>$accommodationSlot->user->pic_name,
            'body1'=>'We are grateful to inform you that your accommodation slot registration has been confirmed.',
            'body2'=>'Please proceed to the payment for your slot by clicking the button below.',
            'url' => 'http://aeo.mybnec.org/dashboard/accommodation-step-2'

        ];
        Mail::to($accommodationSlot->user->email)->send(new ConfirmedSlotMail($confirmedMail));
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
        $rejectMail = [
            'subject' => $accommodationSlot->accommodation->room_type. " - Rejection Slot",
            'name'=>$accommodationSlot->user->pic_name,
            'body1'=>'We are regretful to inform you that your accommodation slot has been rejected with the following reason: ',
            'body2'=>'You can edit your slot registration again by going into the registration step on our website.',
            'reason' => $request->reason,
            'url' => 'http://aeo.mybnec.org/dashboard/accommodation-step-1',

        ];
        Mail::to($accommodationSlot->user->email)->send(new RejectionMail($rejectMail));
        return redirect()->route('accommodation-slot-registrations.index');
    }
}

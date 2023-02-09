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
        $this->middleware('IsAdmin')->except(['create','store','destroy','edit','update']);
        $this->middleware('auth')->only(['create','store','destroy']);
    }

    public function index()
    {
        $pending = AccommodationSlot::where('is_confirmed', 0)->get();
        $confirmed = AccommodationSlot::leftJoin('accommodation_payments','accommodation_slot_details.payment_id','accommodation_payments.id')
            ->where('accommodation_slot_details.is_confirmed',1)
            ->Where('accommodation_slot_details.payment_id', NULL)
            ->select('accommodation_slot_details.*')
            ->get();

        $confirmedPaid = AccommodationSlot::leftJoin('accommodation_payments','accommodation_slot_details.payment_id','accommodation_payments.id')
            ->where('accommodation_slot_details.is_confirmed',1)
            ->Where('accommodation_slot_details.payment_id','!=' ,NULL)
            ->select('accommodation_slot_details.*')
            ->get();
        $rejected = AccommodationSlot::where('is_confirmed', -1)->get();
    
        return view('accommodation-slot-registrations.index', [
            'accommodations' => AccommodationSlot::with('accommodation')->get(),
            'pending' => $pending,
            'confirmed' => $confirmed,
            'confirmedPaid' => $confirmedPaid,
            'rejected' => $rejected,
        ]);
    }

    public function create($accommodation = 1 ) {
        return view('accommodation-slot-registrations.create', [
            'accommodations' => Accommodation::all(),
            'selectedType' =>  Accommodation::find($accommodation)
        ]);
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'accommodation_id'=>'required', 
            'check_in_date'=>'required |after_or_equal:2023-02-10|before:2023-02-13',
            'check_out_date'=>'required|after:2023-02-18',
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
        return redirect()->route('dashboard.accommodation-step',1)->with('success', "Accommodation registration successfully updated!");
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
        if ($accommodation_slot_registration->is_confirmed == 1  && !Auth::guard('admin')->check() )return redirect()->back()->with('error','Unable to edit this slot, because this slot have already confirmed');
        $request->validate([
            'accommodation_id'=>'required', 
            'check_in_date'=>'required | after_or_equal:2023-02-01',
            'check_out_date'=>'required|after:check_in_date|before:2023-02-28',
            'special_req'=>'nullable|string',
            'quantity'=>'required',
        ]);
        if(!Auth::guard('admin')->check()) $user = Auth::user()->username;
        else $user = Auth::guard('admin')->user()->name;
        
        $accommodation_slot_registration->update([
            'updated_by' => $user,
            'accommodation_id' => $request->accommodation_id,
            'check_in_date'=>$request->check_in_date,
            'check_out_date'=>$request->check_out_date,
            'special_req'=>$request->special_req,
            'quantity' => $request->quantity,
        ]);
        if(!Auth::guard('admin')->check()){
            $accommodation_slot_registration->update([
                'is_confirmed' => 0,
            ]);
        }

        if(!Auth::guard('admin')->check()){
            return redirect()->route('dashboard.accommodation-step',1)->with('success', "Accommodation registration successfully updated!");
        }
        else{
            return redirect()->route('accommodation-slot-registrations.index')->with('success', "Accommodation registration successfully updated!");
        }
    }


    public function destroy($accommodationSlot)
    {
        $slot = AccommodationSlot::find($accommodationSlot);
        if ($slot->is_confirmed == 1)return redirect()->back()->with('error','Unable to delete this slot, because this slot have already confirmed');
        $slot->delete();
        return redirect()->back()->with('success','Accommodation slot is successfuly deleted');
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
            'body1'=>'We are grateful to inform you that your '.$accommodationSlot->accommodation->room_type .' slot registration has been confirmed.',
            'body2'=>'Please proceed to the payment for your slot by clicking the button below.',
            'url' => 'http://aeo.mybnec.org/dashboard/accommodation-step-2'

        ];
        Mail::to($accommodationSlot->user->email)->send(new ConfirmedSlotMail($confirmedMail));
        return redirect()->route('accommodation-slot-registrations.index')->with('success','accommodation is successfuly confirmed');
    }

    public function cancel (AccommodationSlot $accommodationSlot){
        $accommodationSlot ->update([
            'updated_by' => 'Admin',
            'is_confirmed' => 0
        ]);
        return redirect()->route('accommodation-slot-registrations.index');
    }
    public function reject ( Request $request){
        $accommodationSlot = AccommodationSlot::find($request->slot);
        $accommodationSlot ->update([
            'updated_by' => Auth::guard('admin')->user()->name,
            'is_confirmed' => -1
        ]);
        $rejectMail = [
            'subject' => $accommodationSlot->accommodation->room_type. " - Rejection Slot",
            'name'=>$accommodationSlot->user->pic_name,
            'body1'=>'We are regretful to inform you that your '.$accommodationSlot->accommodation->room_type.' slot has been rejected with the following reason: ',
            'body2'=>'You can edit your slot registration again by going into the registration step on our website.',
            'reason' => $request->reason,
            'url' => 'http://aeo.mybnec.org/dashboard/accommodation-step-1',

        ];
        Mail::to($accommodationSlot->user->email)->send(new RejectionMail($rejectMail));
        return redirect()->route('accommodation-slot-registrations.index')->with('success', 'Accommodation is successfuly rejected');
    }
}

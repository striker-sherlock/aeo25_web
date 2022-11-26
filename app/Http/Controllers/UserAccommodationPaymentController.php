<?php

namespace App\Http\Controllers;
use App\Models\Accommodation;
use Illuminate\Http\Request;
use App\Models\AccommodationSlot;
use App\Models\PaymentProvider;
use App\Models\AccommodationPayment;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class UserAccommodationPaymentController extends Controller
{
    public function __construct(){
        $this->middleware('auth', 'verified');
        $this->middleware('IsShowed:ENV005');
    }

    public function getAllSlotRegistered($id)
    {
        return AccommodationSlot::where('pic_id', $id)
        ->where('payment_id', NULL)->where('is_confirmed', 1)
        ->get();
    }


    public function create($id)
    {
        $slot = AccommodationSlot::find($id);
        $accommodation = NULL;
        $payAll = 0;
        $allAccommodation = NULL;
        $isPaid = false;

        if($slot == NULL){
            $payAll = 1;
            $allAccommodation = $this->getAllSlotRegistered(Auth::user()->id);
            $total = 0;
            foreach($allAccommodation as $accommodationSlot){
                $total += $accommodationSlot->quantity *  $accommodationSlot->accommodation->price;

            }
        }

        else{
            $accommodation = Accommodation::where('id', $slot->accommodation_id)->first();
            $total = $slot->quantity * $accommodation->price;
            if($slot->accommodationPayment){
                $isPaid = true;
            }
        }
        return view('accommodation-payments.create',[
            'total' =>$total,
            'accommodationSlot' => $slot,
            'payAll' => $payAll,
            'allAccommodations' => $allAccommodation,
            'isPaid' => $isPaid,
            'paymentProviders' => PaymentProvider::select('name', 'id')->distinct()->get(),

        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'account_name' => 'nullable|string',
            'account_number' => 'nullable|numeric',
            'email' => 'nullable|string',
            'track' => 'nullable|string',
            'transfer_proof_bank' => 'nullable|image|max:1999|mimes:jpg,png,jpeg',
            'transfer_proof_wise' => 'nullable|image|max:1999|mimes:jpg,png,jpeg',
        ]);
        $pic = Auth::user()->username;
        $fileName = str_replace(' ', '-', $pic );
        $fileName = preg_replace('/[^A-Za-z0-9\-]/', '', $fileName);
        $fileName = str_replace('-', '_', $fileName);
        $current = time();

        if ($request->hasFile('transfer_proof_bank')){
            $extension = $request->file('transfer_proof_bank')->getClientOriginalExtension();
            $fixedName = $fileName.'_'.$current.'.'.$extension;
            $path = $request->file("transfer_proof_bank")->storeAs("public/transfer_proof",$fixedName);
        }
        if ($request->hasFile('transfer_proof_wise')){
            $extension = $request->file('transfer_proof_wise')->getClientOriginalExtension();
            $fixedName = $fileName.'_'.$current.'.'.$extension;
            $path = $request->file("transfer_proof_wise")->storeAs("public/transfer_proof",$fixedName);
        }
        $payment = AccommodationPayment::create([
            'pic_id' => Auth::user()->id,
            'payment_provider_id' => $request->payment_provider,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'email' => $request->email,
            'tracking_link' => $request->track,
            'payment_proof' => $fixedName,
            'amount' => $request->amount,
            'is_confirmed' => 0,
            'created_by' => Auth::user()->username,
        ]);

        if ($request->payAll == 1){
            $allAccommodation = $this->getAllSlotRegistered($request->pic_id);
            foreach($allAccommodation as $accommodation){
                $accomodation->update([
                    'payment_id' => $payment->id,
                ]);
            }
        }
        else{
            $accommodationSlot = AccommodationSlot::find($request->accommodationSlot);
            $accommodationSlot->update([
                'payment_id' => $payment->id,
            ]);
        }
        return redirect()->route('dashboard.accommodation-step',2)->with('success','Payment successfuly submitted, Please wait for confirmation');
    }

    public function show($id)
    {
        //
    }

    public function edit(AccommodationPayment $accommodationPayment)
    {
        $paidSlot= AccommodationSlot::where('payment_id',$accommodationPayment->id)->get();
        return view('accommodation-payments.edit',[
            'accommodationPayment' => $accommodationPayment,
            'paidSlot' =>$paidSlot,
            'paymentProviders' => PaymentProvider::all()
        ]);
    }

    public function update(Request $request, AccommodationPayment $accommodationPayment)
    {
        $request->validate([
            'account_name' => 'nullable|string',
            'account_number' => 'nullable|numeric',
            'email' => 'nullable|string',
            'track' => 'nullable|string',
            'transfer_proof_bank' => 'nullable|image|max:1999|mimes:jpg,png,jpeg',
            'transfer_proof_wise' => 'nullable|image|max:1999|mimes:jpg,png,jpeg',
        ]);

        $pic = Auth::user()->username;
        $fileName = str_replace(' ', '-', $pic );
        $fileName = preg_replace('/[^A-Za-z0-9\-]/', '', $fileName);
        $fileName = str_replace('-', '_', $fileName);
        $current = time();
        
        // kalo payment type nya bank
        if($request->type == 'BANK'){
            if ($request->hasFile('transfer_proof_bank')){
                $extension = $request->file('transfer_proof_bank')->getClientOriginalExtension();
                $fixedName = $fileName.'_'.$current.'.'.$extension;
                $path = $request->file("transfer_proof_bank")->storeAs("public/transfer_proof",$fixedName);
            }
            else{
                $fixedName = $request->transfer_proof_old;
            }
            $accommodationPayment->update([
                'payment_provider_id' => $request->payment_provider,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
                'payment_proof' => $fixedName,
                'updated_by' => Auth::user()->username,
                'is_confirmed' => 0,
            ]);
        }

        // ini untuk update menjadi wise
        else{
            if ($request->hasFile('transfer_proof_wise')){
                $extension = $request->file('transfer_proof_wise')->getClientOriginalExtension();
                $fixedName = $fileName.'_'.$current.'.'.$extension;
                $path = $request->file("transfer_proof_wise")->storeAs("public/transfer_proof",$fixedName);
            }
            else{
                $fixedName = $request->transfer_proof_old;
            }
            $accommodationPayment->update([
                'payment_provider_id' => 18,
                'email' => $request->email,
                'tracking_link' => $request->track,
                'payment_proof' => $fixedName,
                'updated_by' => Auth::user()->username,
                'is_confirmed' => 0,
            ]);

        }
    }

    public function destroy(AccommodationPayment $accommodationPayment)
    {
        $accommodationPayment->delete();
        $accommodationSlots = AccommodationSlot::where('payment_id', $accommodationPayment->id)->get();
        foreach ($accommodationSlots as $accommodationSlot) {
            $accommodationSlot->update([
                'payment_id' => NULL
            ]);
        }
        return redirect()->back()->with('success','Payment successfully deleted');
    }
}

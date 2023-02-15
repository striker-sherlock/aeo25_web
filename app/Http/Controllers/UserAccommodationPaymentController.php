<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Accommodation;
use Illuminate\Support\Carbon;
use App\Models\PaymentProvider;
use App\Models\AccommodationSlot;
use Illuminate\Support\Facades\DB;
use App\Models\AccommodationPayment;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class UserAccommodationPaymentController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'verified'])->except(['edit','update']);
        $this->middleware('IsShowed:ENV005');
    }

    public function getAllSlotRegistered($id){
        return AccommodationSlot::where('pic_id', $id)
            ->where('payment_id', NULL)
            ->where('is_confirmed', 1)
            ->get();
    }

    public function calculateNight(String $start,String $end){
        $start = Carbon::createFromDate($start);
        $end = Carbon::createFromDate($end);
        return $start->diffInDays($end);
    }

    public function create($id){
        $slot = AccommodationSlot::find($id);
        $accommodation = NULL;
        $payAll = 0;
        $allAccommodation = NULL;
        $isPaid = false;
        $days = NULL;

        if($slot == NULL){
            $payAll = 1;
            $allAccommodation = $this->getAllSlotRegistered(Auth::user()->id);
            $total = 0;
            foreach($allAccommodation as $accommodationSlot){
                $days = $this->calculateNight($accommodationSlot->check_in_date,$accommodationSlot->check_out_date);
                $total += $accommodationSlot->quantity *  $accommodationSlot->accommodation->price  * $days;

            }
        }

        else{
            $days = $this->calculateNight($slot->check_in_date,$slot->check_out_date);
            $accommodation = Accommodation::where('id', $slot->accommodation_id)->first();
            $total = $slot->quantity * $accommodation->price * $days;
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
            'paymentProviders' => PaymentProvider::orderBy('name')->where('type','BANK')->get(),
            'user' => Auth::user(),
            'slotId' => $id,
            'days' => $days  


        ]);
    }

    public function store(Request $request)
    {
        if ($request->type == 'bank'){
            $request->validate([
                'account_name' => 'required|string',
                'account_number' => 'required|numeric',
                'payment_provider' => 'required|numeric',
                'transfer_proof_bank' => 'required|image|max:1999|mimes:jpg,png,jpeg',

            ]);
        }
        elseif ($request->type == 'wise'){
            $request->payment_provider = 18;
            $request->validate([
            'email' => 'required|string',
            'track' => 'required|string',
            'transfer_proof_wise' => 'required|image|max:1999|mimes:jpg,png,jpeg',
            ]);
        }
        
        $pic = Auth::user()->username ;
        $fileName = str_replace(' ', '-', $pic );
        $fileName = preg_replace('/[^A-Za-z0-9\-]/', '', $fileName);
        $fileName = str_replace('-', '_', $fileName);
        $current = time();

        if ($request->hasFile('transfer_proof_bank')){
            $extension = $request->file('transfer_proof_bank')->getClientOriginalExtension();
            $fixedName = $fileName.'_'.$current.'.'.$extension;
            $path = $request->file("transfer_proof_bank")->storeAs("public/transfer_proof",$fixedName);
        }
        else if ($request->hasFile('transfer_proof_wise')){
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
                $accommodation->update([
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


    public function edit(AccommodationPayment $accommodationPayment)
    {
        $paidSlot= AccommodationSlot::where('payment_id', $accommodationPayment->id )->get();
        // $this->calculateNight($paidSlot[0]->check_in_date,$paidSlot[0]->check_out_date);
        return view('accommodation-payments.edit',[
            'accommodationPayment' => $accommodationPayment,
            'paymentProviders' => PaymentProvider::orderBy('name')->where('type','BANK')->get(),
            'paidSlot' =>$paidSlot,
            'user' => Auth::user(),
            'slotId' => $paidSlot->first()->id,
          
            
        ]);
    }

    public function update(Request $request, AccommodationPayment $accommodationPayment){
        if($accommodationPayment->is_confirmed == 1 && !Auth::guard('admin')->check())return redirect()->route('dashboard.accommodation-step',2)->with('error','Sorry, unable to edit this payment, because the payment has already confirmed');
        
        if ($request->type == 'BANK'){
            $request->validate([
                'account_name' => 'required|string',
                'account_number' => 'required|numeric',
                'payment_provider' => 'required|numeric',
                'transfer_proof_bank' => 'nullable|image|max:1999|mimes:jpg,png,jpeg',
            ]);
        }
        elseif ($request->type == 'WISE'){
            $request->validate([
                'email' => 'required|string',
                'track' => 'required|string',
                'transfer_proof_wise' => 'nullable|image|max:1999|mimes:jpg,png,jpeg',
            ]);
        }
        $pic = User::find($accommodationPayment->user->id)->username;
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
                'updated_by' => Auth::guard('admin')->check() ? Auth::guard('admin')->user()->name  : Auth::user()->username,
                'email' => $request->email,
                'tracking_link' => $request->track,
            ]);
            if(!Auth::guard('admin')->check()){
                $accommodationPayment->update([
                    'is_confirmed' => 0,
                ]);
            }

        }

        // ini untuk update menjadi wise
        elseif($request->type == 'WISE'){
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
                'account_name' => null,
                'account_number' => null,
                'updated_by' =>Auth::guard('admin')->check() ? Auth::guard('admin')->user()->name  : Auth::user()->username,
            ]);
            
            if(!Auth::guard('admin')->check()){
                $accommodationPayment->update([
                    'is_confirmed' => 0,
                ]);
            }

        }
        if(!Auth::guard('admin')->check())  return redirect()->route('dashboard.accommodation-step',2)->with('success','Accommodation payment successfuly updated ');
        else return redirect()->route('accommodation-payments.index')->with('success','Accommodation payment successfuly updated ');
    }

    public function destroy(AccommodationPayment $accommodationPayment)
    {
        // dd($accommodationPayment);
        if($accommodationPayment->is_confirmed == 1)return redirect()->route('dashboard.accommodation-step',2)->with('error','Sorry, unable to delete this payment, because the payment has already confirmed');
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

<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;
use App\Models\CompetitionSlot;
use App\Models\PaymentProvider;
use App\Models\CompetitionPayment;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class UserCompetitionPaymentController extends Controller
{
    public function __construct(){
        $this->middleware(['auth','verified'])->except(['edit','update']);
        $this->middleware('IsShowed:ENV007');
    }

    public function getAllCompetitionRegistered($id){
        return CompetitionSlot::where('pic_id',$id)
            ->where('payment_id',NULL)
            ->where('is_confirmed',1)
            ->get();

    }

    public function create($id){
        
        $slot = CompetitionSlot::find($id);
        $competition = NULL;
        $isPayAll = 0;
        $allCompetition = NULL;
        $isPaid = false;


        // ini kalo pay all
        if ($slot == NULL){
            $isPayAll = 1;
            $allCompetition = $this->getAllCompetitionRegistered(Auth::user()->id);
            $totalPrice = 0;
            foreach ($allCompetition as $competitionSlot) {
                $totalPrice += $competitionSlot->quantity * $competitionSlot->competition->price; 
            }
          
        }

        // ini kalo bayar per slot 
        else{
            $competition = Competition::where('id',$slot->competition_id)->first();
            $totalPrice = $slot->quantity * $competition->price;
            if($slot->payment)$isPaid = true;
        }
        
        // if($totalPrice == 0 || $isPaid ) return redirect()->back()->with('error','Please wait the payment to be checked by admin ');

        return view('competition-payments.create',[
            'totalPrice' =>$totalPrice,
            'competitionSlot' => $slot,
            'isPayAll' => $isPayAll,
            'allCompetitions' => $allCompetition,
            'isPaid' => $isPaid,
            'paymentProviders' => PaymentProvider::where('type','BANK')->get(),
            'user' => Auth::user(),
            'slotId' => $id,

        ]);
    }

    public function store(Request $request){
    
        if($request->type == "bank"){
            $request->validate([
                'payment_provider' => 'required',
                'transfer_proof_bank' => 'required|image|max:1999|mimes:jpg,png,jpeg',
                'account_name' => 'required|string',
                'account_number' => 'required|numeric',
            ]);
        }
        elseif ($request->type == "wise"){
            $request->validate([
                'email' => 'required|string',
                'track' => 'required|string',
                'transfer_proof_wise' => 'required|image|max:1999|mimes:jpg,png,jpeg',
            ]);
        }
        
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
        $payment = CompetitionPayment::create([
            'pic_id' => Auth::user()->id,
            'payment_provider_id' => $request->payment_provider ? $request->payment_provider : 18,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'email' => $request->email,
            'tracking_link' => $request->track,
            'payment_proof' => $fixedName,
            'amount' => $request->amount,
            'is_confirmed' => 0,
            'created_by' => Auth::user()->username,
        ]);

        if ($request->isPayAll == 1){
            $allCompetition = $this->getAllCompetitionRegistered($request->pic_id);
            foreach($allCompetition as $competition){
                $competition->update([
                    'payment_id' => $payment->id,
                ]);
            }
        }
        else{
            $competitionSlot = CompetitionSlot::find($request->competitionSlot);
            $competitionSlot->update([
                'payment_id' => $payment->id,
            ]);
        }
        
        return redirect()->route('dashboard.step',2)->with('success','Payment successfuly submitted, Please wait for the confirmation');
    }

    
    public function edit(CompetitionPayment $competitionPayment){
        $paidSlot= CompetitionSlot::where('payment_id', $competitionPayment->id)->get();
        
        return view('competition-payments.edit',[
            'competitionPayment' => $competitionPayment,
            'paidSlot' =>$paidSlot,
            'paymentProviders' => PaymentProvider::all(),
            'user' => Auth::user(),
            'slotId' => $competitionPayment->id,

        ]);
    }

    public function update(Request $request, CompetitionPayment $competitionPayment){
        if($request->type == "BANK"){
            $request->validate([
                'payment_provider' => 'required',
                'transfer_proof_bank' => 'nullable|image|max:1999|mimes:jpg,png,jpeg',
                'account_name' => 'required|string',
                'account_number' => 'required|numeric',
            ]);
        }
        elseif ($request->type == "Wise"){
            $request->validate([
                'email' => 'required|string',
                'track' => 'required|string',
                'transfer_proof_wise' => 'nullable|image|max:1999|mimes:jpg,png,jpeg',
            ]);
        }
 
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
            $competitionPayment->update([
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
            $competitionPayment->update([
                'payment_provider_id' => 18,
                'email' => $request->email,
                'tracking_link' => $request->track,
                'payment_proof' => $fixedName,
                'updated_by' => Auth::user()->username,
                'is_confirmed' => 0,
            ]);

        }

        
       
        

        return redirect()->route('dashboard.step',2)->with('success','Payment successfuly updated');
    }

    public function destroy(CompetitionPayment $competitionPayment ){
        $competitionPayment->delete();
        $competitionSlots = CompetitionSlot::where('payment_id',$competitionPayment->id)->get();
        foreach ($competitionSlots as $competitionSlot) {
            $competitionSlot->update([
                'payment_id' => NULL
            ]);
        }
        return redirect()->back()->with('success','Payment successfully deleted');
    }
}

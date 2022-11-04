<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;
use App\Models\CompetitionSlot;
use App\Models\CompetitionPayment;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class UserCompetitionPaymentController extends Controller
{
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

        if ($slot == NULL){
            $isPayAll = 1;
            $allCompetition = $this->getAllCompetitionRegistered(Auth::user()->id);
            $totalPrice = 0;
            foreach ($allCompetition as $competitionSlot) {
                $totalPrice += $competitionSlot->quantity * $competitionSlot->competition->price; 
            }
          
        }
        else{
            $competition = Competition::where('id',$slot->competition_id)->first();
            $totalPrice = $slot->quantity * $competition->price;
            if($slot->payment)$isPaid = true;
        }
        
        if($totalPrice == 0 || $isPaid ) return redirect()->back()->with('error','Please wait the payment to be checked by admin ');

        return view('competition-payments.create',[
            'totalPrice' =>$totalPrice,
            'competitionSlot' => $slot,
            'isPayAll' => $isPayAll,
            'allCompetitions' => $allCompetition,
        ]);
    }

    public function store(Request $request){
        // dd($request->competitionSlot);
        $request->validate([
            'account_name' => 'nullable|string',
            'account_number' => 'nullable|string',
            'email' => 'nullable|string',
            'track' => 'nullable|string',
            'transfer_proof_bank' => 'nullable|image|max:1999|mimes:jpg,png,jpeg',
            'transfer_proof_wise' => 'nullable|image|max:1999|mimes:jpg,png,jpeg',
        ]);
        $pic = Auth::user()->name;
        $fileName = str_replace(' ', '-', $pic );
        $fileName = preg_replace('/[^A-Za-z0-9\-]/', '', $fileName);
        $fileName = str_replace('-', '_', $fileName);
        $current = time();
        if ($request->hasFile('transfer_proof_bank')){
            $extension = $request->file('transfer_proof_bank')->getClientOriginalExtension();
            $file_name = $fileName.'_'.$current.'.'.$extension;
            $path = $request->file("transfer_proof_bank")->storeAs("public/transfer_proof/",$fileName);
        }
        if ($request->hasFile('transfer_proof_wise')){
            $extension = $request->file('transfer_proof_wise')->getClientOriginalExtension();
            $file_name = $fileName.'_'.$current.'.'.$extension;
            $path = $request->file("transfer_proof_wise")->storeAs("public/transfer_proof/",$fileName);
        }

        $payment = CompetitionPayment::create([
            'pic_id' => Auth::user()->id,
            'payment_provider_id' => 1,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'email' => $request->track,
            'tracking_link' => $request->track,
            'payment_proof' => $file_name,
            'amount' => $request->amount,
            'is_confirmed' => 0,
            'created_by' => Auth::user()->pic_name,
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
        
        return redirect()->route('dashboard.step',2)->with('suceess','Payment successfuly submitted, Please wait for the confirmation');
    }

}

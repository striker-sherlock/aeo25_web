<?php

namespace App\Http\Controllers;

use App\Mail\RejectionMail;
use Illuminate\Http\Request;
use App\Mail\ConfirmedSlotMail;
use App\Models\CompetitionSlot;
use App\Models\CompetitionPayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CompetitionPaymentExport;

class AdminCompetitionPaymentController extends Controller
{
    public function index($type){
        if ($type == 'international'){
            $competitionPayment = DB::table('competition_payments')
                ->join('users','competition_payments.pic_id','=','users.id')
                ->join('countries', 'countries.id', '=' , 'users.country_id')  
                ->where('countries.name', '!=' ,'indonesia')
                ->select('competition_payments.*','countries.name','users.*','competition_payments.created_at','competition_payments.id as id', 'payment_proof')  
                ->get();
        } else{
            $competitionPayment = DB::table('competition_payments')
            ->join('users','competition_payments.pic_id','=','users.id')
            ->join('countries', 'countries.id', '=' , 'users.country_id')  
            -> where('countries.name','indonesia')
            ->select('competition_payments.*','countries.name','users.*','competition_payments.created_at','competition_payments.id as id','payment_proof')  
            ->get();
        }

        $pending =  $competitionPayment->where('is_confirmed', 0);
        $confirmed =  $competitionPayment->where('is_confirmed', 1);
        $rejected =  $competitionPayment->where('is_confirmed', -1);

        return view('competition-payments.index',[
            'pending' => $pending,
            'confirmed' => $confirmed,
            'rejected' => $rejected,
        ]);
    }

    public function confirm($id){
        $competitionPayment = CompetitionPayment::find($id);
        $competitionSlots = $competitionPayment->competitionSlot;

        foreach ($competitionSlots as $competitionSlot) {
            $competition = $competitionSlot->competition;
            $competition->update([
                'fixed_quota' => $competition->fixed_quota - $competitionSlot->quantity,
            ]);
        }

        $competitionPayment ->update([
            'is_confirmed' => 1,
            'updated_by' => Auth::guard('admin')->user()->name,
        ]);

        $confirmedMail = [
            'subject' =>"Confirmed Competition Payment",
            'name'=>$competitionPayment->user->pic_name,
            'body' => 'Your Competition Payment have confirmed', 
            'url' => 'http://aeo.mybnec.org/dashboard/step-3'

        ];
        Mail::to($competitionPayment->user->email)->send(new ConfirmedSlotMail($confirmedMail));

        return redirect()->back()->with('success','Payment is successfuly confirmed');


    }

    public function cancel($id){
        $competitionPayment = CompetitionPayment::find($id);
        $competitionSlots = $competitionPayment->competitionSlot;
        // dd($competitionSlots);

        foreach ($competitionSlots as $competitionSlot) {
            $competition = $competitionSlot->competition;
            $competition->update([
                'fixed_quota' => $competition->fixed_quota + $competitionSlot->quantity,
            ]);
        }

        
        $competitionPayment ->update([
            'is_confirmed' => 0,
            'updated_by' => Auth::guard('admin')->user()->name,
        ]);

        foreach ($competitionSlots as $competitionSlot){
            $competitionSlot->update([
                'payment_id' => NULL,
            ]);
        }

        return redirect()->back()->with('success', 'The payment successfully canceled');
    }

    public function export(){
        return Excel::download(new CompetitionPaymentExport, 'competition-payments.xlsx');
    }

    public function reject(Request $request){
        $competitionPayment= CompetitionPayment::find($request->payment);
    // dd($competitionPayment);
        $competitionPayment->update([
            'is_confirmed' => -1
        ]);

        // $competitionSlots = CompetitionSlot::where('payment_id',$request->payment)->get();

        // foreach ($competitionSlots as $competitionSlot){
        //     $competitionSlot->update([
        //         'payment_id' => NULL,
        //     ]);
        // }

        $rejectMail = [
            'subject' => "Competition Payment Rejection",
            'name'=>$competitionPayment->user->name,
            'reason' => $request->reason,

        ];
        Mail::to($competitionPayment->user->email)->send(new RejectionMail($rejectMail));
        return redirect()->back()->with('success', 'Payment is Successfuly rejected');
    }
}

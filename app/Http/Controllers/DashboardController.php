<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;
use App\Models\CompetitionSlot;
use App\Models\CompetitionPayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\CompetitionParticipant;

class DashboardController extends Controller
{
    public function __construct(){
 
        $this->middleware(['auth', 'verified'])->only(['showDashboard','step']);
        $this->middleware('IsAdmin')->only(['showAdminDashboard']);
    }

    public function showDashboard(){
        return view('dashboards.user', [
        ]);
    }
    public function step($step){
        if ($step == 1){
            return view('dashboards.step-one');
        }


        if ($step == 2){
            // jika step-1 belum di confirmasi atau belom dilewati maka, kembali ke dashboard
            // dd(Auth::user()->id);
            $confirmedSlot = CompetitionSlot::find(Auth::user()->id);
            if ($confirmedSlot == NULL ) return redirect()->route('dashboard')->with('error','You Have to make slot registration first');

            $confirmedSlot = $confirmedSlot->where('is_confirmed',1)->get();
            if ($confirmedSlot ->count() == 0) return redirect()->route('dashboard')->with('error','Please Wait your slot registration to be confirmed by admin');
            
            $history = DB::table('competition_slot_details')
                        ->join('competition_payments','competition_slot_details.payment_id','=','competition_payments.id')
                        ->join('competitions','competition_slot_details.competition_id','=','competitions.id')
                        ->where('competition_payments.is_confirmed','!=',NULL)
                        ->select('competition_payments.is_confirmed as is_confirmed','competition_payments.id as id','competitions.id as competition_id','competition_payments.created_at','competitions.name','competitions.need_team','quantity','competition_payments.updated_at as updated_at')
                        ->get();

            
            $competitionPayment = competitionSlot::where('pic_id',Auth::user()->id)->get()->where('payment_id',NULL);
            // dd($competitionPayment); 
            return view('dashboards.step-two',[
                'confirmedSlot' => $confirmedSlot,
                'history' => $history,
                'isPaidAll' => $competitionPayment
            ]);
  
        }

        if ($step == 3){
            // validate eligibility
            $competitionPayment = CompetitionPayment::where('pic_id', Auth::user()->id)->get();
            if ($competitionPayment == NULL )return redirect()->route('dashboards.step',2)->with('error','Please make a payment first');
            
            $competitionPayment = $competitionPayment->where('is_confirmed',1);
            if ($competitionPayment == NULL )return redirect()->route('dashboards.step',2)->with('error','Please wait your payment to be confirmed');
            
            $competitionSlots = CompetitionSlot::where('pic_id',Auth::user()->id)->get();
            $competitionParticipant  = CompetitionParticipant::where('pic_id', Auth::user()->id)->get();
             
            return view('dashboards.step-three',[
                'competitionSlots' => $competitionSlots,
                'competitionParticipant' => $competitionParticipant,    

            ]);
        }
    }
    
    public function showAdminDashboard(){
        return view('dashboards.admin', [
            'competitions' => Competition::all(),
            
        ]);
     }
}

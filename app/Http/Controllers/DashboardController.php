<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Competition;
use Illuminate\Http\Request;
use App\Models\CompetitionSlot;
use App\Models\CompetitionPayment;
use App\Models\CompetitionSummary;
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
        $allSlotRegistration = CompetitionSlot::where('pic_id',Auth::user()->id)->get();
        $confirmedSlotRegistration =  $allSlotRegistration->where('is_confirmed',1);
        $confirmedPayment = CompetitionPayment::where('pic_id', Auth::user()->id)->get()->where('is_confirmed',1);
        // dd($confirmedPayment);
        return view('dashboards.user', [
            'allSlotRegistration' => $allSlotRegistration,
            'confirmedSlotRegistration' => $confirmedSlotRegistration,
            'confirmedPayment' => $confirmedPayment
        ]);
    }
    public function step($step){
        if ($step == 1){
            $competitionSlots = CompetitionSlot::where('pic_id', Auth::user()->id)->get();
            $confirmedSlot = CompetitionSlot::where('pic_id',Auth::user()->id);
            return view('dashboards.step-one',[
                'competitionSlots' => $competitionSlots,
            ]);
        }


        if ($step == 2){
            // jika step-1 belum di confirmasi atau belom dilewati maka, kembali ke dashboard
            $confirmedSlot = CompetitionSlot::where('pic_id',Auth::user()->id)->get();
            if ($confirmedSlot->count() == 0) return redirect()->route('dashboard')->with('error','You have to make slot registration first');

            $confirmedSlot = $confirmedSlot->where('is_confirmed',1);
            if ($confirmedSlot ->count() == 0) return redirect()->route('dashboard')->with('error','Please Wait your slot registration to be confirmed by admin');
            
            $history = DB::table('competition_slot_details')
                        ->join('competition_payments','competition_slot_details.payment_id','=','competition_payments.id')
                        ->join('competitions','competition_slot_details.competition_id','=','competitions.id')
                        ->where('competition_payments.is_confirmed','!=',NULL)
                        ->select('competition_payments.is_confirmed as is_confirmed','competition_payments.id as id','competitions.id as competition_id','competition_payments.created_at','competitions.name','competitions.need_team','quantity','competition_payments.updated_at as updated_at')
                        ->get();

            
            $competitionPayment = competitionSlot::where('pic_id',Auth::user()->id)->get()
                                ->where('payment_id',NULL)
                                ->where('is_confirmed','1');
            return view('dashboards.step-two',[
                'confirmedSlots' => $confirmedSlot,
                'history' => $history,
                'isPaidAll' => $competitionPayment
            ]);
  
        }

        if ($step == 3){
            // validate eligibility
            $competitionPayment = CompetitionPayment::where('pic_id', Auth::user()->id)->get();
            // dd($competitionPayment->count());
            if ($competitionPayment->count() == 0 )return redirect()->back()->with('error','Please make a payment first');
            
            $competitionPayment = $competitionPayment->where('is_confirmed',1);
            if ($competitionPayment->count() == 0 )return redirect()->back()->with('error','Please wait your payment to be confirmed');
            
            $competitionSlots = CompetitionSlot::where('pic_id',Auth::user()->id)->get();
            $competitionParticipant  = CompetitionParticipant::where('pic_id', Auth::user()->id)->get();
             
            return view('dashboards.step-three',[
                'competitionSlots' => $competitionSlots,
                'competitionParticipant' => $competitionParticipant,    

            ]);
        }
    }
    
    public function showAdminDashboard(){
        // menghitung confirmed payment slot 
        $confirmed = CompetitionSlot::join('competition_payments','competition_payments.id','competition_slot_details.payment_id')
            ->where('competition_payments.is_confirmed',1)
            ->select('quantity')
            ->sum('quantity');
        dd($confirmed);
        return view('dashboards.admin', [
            'competitions' => Competition::all(),
            
        ]);
    }

    public function countExpectedParticipant($type){
        $counterDB = 0;
        $counterRD = 0;
        $counterOther = 0;
        $expectedParticipant = 0;

        if ($type == 'NATIONAL'){
            $expectedParticipant = User::join('competition_slot_details', 'competition_slot_details.pic_id', 'users.id')
                ->join('countries', 'countries.id', 'users.country_id')
                ->join('competitions', 'competitions.id', 'competition_slot_details.competition_id')
                ->where('competition_slot_details.is_confirmed', '=', 1)
                ->where('countries.name', 'LIKE', 'Indonesia')
                ->select (
                    'competition_slot_details.quantity',
                    'competitions.id',
                )
                ->get();
        }
        else{
            $expectedParticipant = User::join('competition_slot_details', 'competition_slot_details.pic_id', 'users.id')
                ->join('countries', 'countries.id', 'users.country_id')
                ->join('competitions', 'competitions.id', 'competition_slot_details.competition_id')
                ->where('competition_slot_details.is_confirmed', '=', 1)
                ->where('countries.name', '!=', 'Indonesia')
                ->select (
                    'competition_slot_details.quantity',
                    'competitions.id',
                )
                ->get();
        }

        foreach ($expectedParticipant as $participant) {
            if ($participant->id == 'DB') $counterDB += $participant->quantity*2;
            elseif ($participant->id == 'RD') $counterRD += $participant->quantity*2;
            else $counterOther += $participant->quantity;
        }
        return $counterRD + $counterDB + $counterOther;
    }

    public function countTotalParticipant($type){
        $counterDB = 0;
        $counterRD = 0;
        $counterOther = 0;
        $expectedParticipant = 0;

        if ($type == 'NATIONAL'){
            $expectedParticipant = User::join('competition_slot_details', 'competition_slot_details.pic_id', 'users.id')
                ->join('countries', 'countries.id', 'users.country_id')
                ->join('competitions', 'competitions.id', 'competition_slot_details.competition_id')
                ->join('competition_payments','competition_slot_details.payment_id','competition_payments.id')
                ->where('competition_payments.is_confirmed', 1)
                ->where('countries.name', 'LIKE', 'Indonesia')
                ->select (
                    'competition_slot_details.quantity',
                    'competitions.id',
                )
                ->get();
        }
        else{
            $expectedParticipant = User::join('competition_slot_details', 'competition_slot_details.pic_id', 'users.id')
                ->join('countries', 'countries.id', 'users.country_id')
                ->join('competitions', 'competitions.id', 'competition_slot_details.competition_id')
                ->join('competition_payments','competition_slot_details.payment_id','competition_payments.id')
                ->where('competition_payments.is_confirmed', 1)
                ->where('countries.name', '!=', 'Indonesia')
                ->select (
                    'competition_slot_details.quantity',
                    'competitions.id',
                )
                ->get();
        }

        foreach ($expectedParticipant as $participant) {
            if ($participant->id == 'DB') $counterDB += $participant->quantity*2;
            elseif ($participant->id == 'RD') $counterRD += $participant->quantity*2;
            else $counterOther += $participant->quantity;
        }
        return $counterRD + $counterDB + $counterOther;
    }

    public function createStatistic(){
        try {
            CompetitionSummary::create([
                'date' => date('d/m/Y'),
                'expected_participants' => $this->expectedParticipantCounter("NATIONAL") + $this->expectedParticipantCounter("INTERNATIONAL"),
                'total_participants' => $this->totalParticipantCounter("NATIONAL") +  $this->totalParticipantCounter("INTERNATIONAL"),
            ]);
        }catch(Exception $e) {
            if ($e) return redirect()->back()->with('error', 'Statistic already synced!');
        }
        return redirect()->back()->with('success', 'Statistic Data Created!');
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\Competition;
use Illuminate\Http\Request;
use App\Models\AccommodationSlot;
use App\Models\CompetitionSlot;
use App\Models\AccommodationPayment;
use App\Models\CompetitionPayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\CompetitionParticipant;
use App\Models\AccommodationGuest;

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
            $competitionSlots = CompetitionSlot::where('pic_id', Auth::user()->id)->get();
            
            return view('dashboards.step-one',[
                'competitionSlots' => $competitionSlots,
            ]);
        }


        if ($step == 2){
            // jika step-1 belum di confirmasi atau belom dilewati maka, kembali ke dashboard
            // dd(Auth::user()->id);
            $confirmedSlots = CompetitionSlot::where('pic_id', Auth::user()->id)->get();
            if ($confirmedSlots->count() == 0) return redirect()->route('dashboard')->with('error','You Have to make slot registration first');

            if ($confirmedSlots->where('is_confirmed')->count() == 0) return redirect()->route('dashboard')->with('error','Please Wait your slot registration to be confirmed by admin');
            
            $history = DB::table('competition_slot_details')
                        ->join('competition_payments','competition_slot_details.payment_id','=','competition_payments.id')
                        ->join('competitions','competition_slot_details.competition_id','=','competitions.id')
                        ->where('competition_payments.is_confirmed','!=',NULL)
                        ->select('competition_payments.is_confirmed as is_confirmed','competition_payments.id as id','competitions.id as competition_id','competition_payments.created_at','competitions.name','competitions.need_team','quantity','competition_payments.updated_at as updated_at')
                        ->get();

            
            $competitionPayment = competitionSlot::where('pic_id',Auth::user()->id)->get()->where('payment_id',NULL);
            // dd($competitionPayment); 
            return view('dashboards.step-two',[
                'confirmedSlot' => $confirmedSlots,
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
    
    public function accommodationStep($step){
        if ($step == 1){
            $accommodationSlots = AccommodationSlot::where('pic_id', Auth::user()->id)->get();
            
            return view('dashboards.accommodation-step-one',[
                'accommodationSlots' => $accommodationSlots,
            ]);
        }

        if ($step == 2){
            // jika step-1 belum di confirmasi atau belom dilewati maka, kembali ke dashboard
            // dd(Auth::user()->id);
            $confirmedSlots = AccommodationSlot::where('pic_id', Auth::user()->id)->get();
            if ($confirmedSlots->count() == 0) return redirect()->route('dashboard')->with('error','You Have to make slot registration first');

            if ($confirmedSlots->where('is_confirmed')->count() == 0) return redirect()->route('dashboard')->with('error','Please Wait your slot registration to be confirmed by admin');
            
            $history = DB::table('accommodation_slot_details')
                        ->join('accommodation_payments','accommodation_slot_details.payment_id','=','accommodation_payments.id')
                        ->join('accommodations','accommodation_slot_details.accommodation_id','=','accommodations.id')
                        ->where('accommodation_payments.is_confirmed','!=',NULL)
                        ->select('accommodation_payments.is_confirmed as is_confirmed','accommodation_payments.id as id','accommodations.id as accommodation_id','accommodation_payments.created_at','accommodations.room_type','quantity','accommodation_payments.updated_at as updated_at')
                        ->get();

            
            $accommodationPayment = AccommodationSlot::where('pic_id',Auth::user()->id)->get()->where('payment_id',NULL);
            // dd($competitionPayment); 
            return view('dashboards.accommodation-step-two',[
                'confirmedSlot' => $confirmedSlots,
                'history' => $history,
                'isPaidAll' => $accommodationPayment
            ]);
  
        }

        if ($step == 3){
            // validate eligibility
            $accommodationPayment = AccommodationPayment::where('pic_id', Auth::user()->id)->get();
            if ($accommodationPayment == NULL )return redirect()->route('dashboards.accommodation-step',2)->with('error','Please make a payment first');
            
            $accommodationPayment = $accommodationPayment->where('is_confirmed', 1);
            if ($accommodationPayment == NULL )return redirect()->route('dashboards.accommodation-step',2)->with('error','Please wait your payment to be confirmed');
            
            $accommodationSlots = AccommodationSlot::where('pic_id',Auth::user()->id)->get();
            $accommodationGuest  = AccommodationGuest::where('pic_id', Auth::user()->id)->get();
             
            return view('dashboards.accommodation-step-three',[
                'accommodationSlots' => $accommodationSlots,
                'accommodationGuest' => $accommodationGuest,    

            ]);
        }
    }

    public function showAdminDashboard(){
        return view('dashboards.admin', [
            'competitions' => Competition::all(),
            
        ]);
     }
}

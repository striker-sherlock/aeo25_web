<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;
use App\Models\CompetitionSlot;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(){
        // $this->middleware('admin')->except(['showMenuDashboard', 'showDashboard', 'edit', 'update', 'guideBook', 'certificate', 'rankingList']);
        $this->middleware(['auth', 'verified'])->only(['showDasboard','step']);
        $this->middleware('IsAdmin');
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
            
            $history = CompetitionSlot::where('payment_id','!=',NULL)->get();
            
            return view('dashboards.step-two',[
                'confirmedSlot' => $confirmedSlot,
                'history' => $history,
            ]);
  
        }
    }
    
    public function showAdminDashboard(){
        return view('dashboards.admin', [
            'competitions' => Competition::all(),
            
        ]);
     }
}

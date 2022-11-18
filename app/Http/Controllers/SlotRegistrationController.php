<?php

namespace App\Http\Controllers;

use App\Mail\RejectionMail;
use App\Models\Competition;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Mail\ConfirmedSlotMail;
use App\Models\CompetitionSlot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Arr;

class SlotRegistrationController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only(['create']);
    }
    public function index()
    {
        //data table jangan lupa
        $competitions = Competition::all();
        $count = [];
        foreach ($competitions as $competition){
            $competitionSlot = CompetitionSlot::where('competition_id',$competition->id)
                                ->where('is_confirmed',1)
                                ->sum('quantity');
            $count = array_add($count,$competition->name, $competitionSlot);
        };

        $pending = CompetitionSlot::where('is_confirmed',0)->get();
        $confirmed = CompetitionSlot::where('is_confirmed',1)->get();
        $rejected = CompetitionSlot::where('is_confirmed',-1)->get();
        
        return view('slot-registrations.index',[
            'competitions' =>$competitions,
            'pending' => $pending,
            'confirmed' => $confirmed,
            'rejected' => $rejected,
            'registeredSlot' => $count,
        ]);
    }
    
    public function create()
    {
        return view('slot-registrations.create',[
            'competitions' => Competition::all(),
        ]);
    }

    public function store(Request $request)
    {
        $len = count($request->quantity);
        for ($i= 0; $i < $len; $i++){
            if ($request->quantity[$i] != '0'){
                CompetitionSlot::create([
                    'created_by' => Auth::user()->pic_name,
                    'pic_id' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'competition_id' => $request->compet_id[$i],
                    'quantity' => $request->quantity[$i],
                    'is_confirmed' => 0,
                ]);
            }
        }
        return redirect()->route('slot-registrations.index');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }
    
    public function confirm(CompetitionSlot $competitionSlot){
         
        $competitionSlot ->update([
            'updated_by' => 'Admin',
            'is_confirmed' => 1
        ]);

        
        $remainedParticipant =$competitionSlot ->competition->temp_quota;
        $competitionSlot->competition -> update([
            'temp_quota' => $remainedParticipant - $competitionSlot->quantity,
        ]);

        // $confirmedMail = [
        //     'subject' => $competitionSlot->competition->name. " - Confirmed Slot",
        //     'name'=>$competitionSlot->competition->name,

        // ];
        // Mail::to($competitionSlot->user->email)->send(new ConfirmedSlotMail($confirmedMail));
        return redirect()->route('slot-registrations.index');
    }

    public function cancel (CompetitionSlot $competitionSlot){
        $competitionSlot ->update([
            'updated_by' => 'Admin',
            'is_confirmed' => 0
        ]);

        $remainedParticipant =$competitionSlot ->competition->temp_quota;
        $competitionSlot->competition -> update([
            'temp_quota' => $remainedParticipant + $competitionSlot->quantity,
        ]);
        return redirect()->route('slot-registrations.index');
    }
    public function reject ( Request $request){
        //admin kasi alasan kenapa di reject
        $competitionSlot = CompetitionSlot::find($request->slot);
        // dd($competitionSlot->user->email);
        $competitionSlot ->update([
            'updated_by' => 'Admin',
            'is_confirmed' => -1
        ]);

        // $rejectMail = [
        //     'subject' => $competitionSlot->competition->name. " - Rejection Slot",
        //     'name'=>$competitionSlot->competition->name,
        //     'reason' => $request->reason

        // ];
        // Mail::to($competitionSlot->user->email)->send(new RejectionMail($rejectMail));
        // return redirect()->route('slot-registrations.index');

        

        return redirect()->route('slot-registrations.index');
    }
  
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

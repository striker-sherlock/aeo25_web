<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Mail\RejectionMail;
use App\Models\Competition;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Mail\ConfirmedSlotMail;
use App\Models\CompetitionSlot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SlotRegistrationController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only(['create']);
        $this->middleware('IsShowed:ENV009');
    }

    public function index(){
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
        $confirmed = CompetitionSlot::leftJoin('competition_payments','competition_slot_details.payment_id','competition_payments.id')
            ->where('competition_slot_details.is_confirmed',1)
            ->Where('competition_slot_details.payment_id', NULL)
            ->select('competition_slot_details.*')
            ->get();
        $rejected = CompetitionSlot::where('is_confirmed',-1)->get();
        
        return view('slot-registrations.index',[
            'competitions' =>$competitions,
            'pending' => $pending,
            'confirmed' => $confirmed,
            'rejected' => $rejected,
            'registeredSlot' => $count,
        ]);
    }

    public function create(){
        return view('slot-registrations.create',[
            'competitions' => Competition::all(),
            'competitionSlots' => CompetitionSlot::where('pic_id',Auth::user()->id)->get(),
        ]);
    }
    
    public function checkSlotAvailability(int $slot, $competitionID){
        $allSlotCompetition = CompetitionSlot::where('pic_id',Auth::user()->id)
                            ->get()
                            ->where('competition_id',$competitionID)
                            ->sum('quantity');
        $competition = Competition::find($competitionID);
        if ($slot + $allSlotCompetition > 3) return "Sorry, maximum for each institution exceeded";
        if ($slot > $competition->temp_quota) return "Sorry,".$competition->name."'s quota is not enough";
        return 'true'; 
    }

    public function store(Request $request){
        $len = count($request->quantity);
        //  code ini untuk mengecek apabila slot nya masih tersedia atau tidak
        for($i = 0; $i < $len; $i++){
            if ($request->quantity[$i] != '0')$valid = $this->checkSlotAvailability($request->quantity[$i],$request->compet_id[$i]);
            else continue;
            $competitionName = Competition::find($request->compet_id[$i])->name;
            if(!$valid) return redirect()->back()->with('error',"Sorry, ".$competitionName."'s slot is not available");
        }
        // dd($request->all());    
        
        
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
        return redirect()->route('dashboard.step',1)->with('success','Slot is successfully registered');
    }
    
    public function edit($id) {
        $competitionSlot = CompetitionSlot::find($id);
        $pic = $competitionSlot->user;
        return view('slot-registrations.edit',[
            'competitionSlots' => CompetitionSlot::where('pic_id', $pic->id)->get()->where('is_confirmed',0),
            'pic' => $pic 
        ]);
    }
    
    public function confirm(CompetitionSlot $competitionSlot){
         
        $competitionSlot ->update([
            'updated_by' => 'Admin',
            'is_confirmed' => 1,
            'confirmed_at' => Carbon::now()
        ]);

        $remainedParticipant =$competitionSlot ->competition->temp_quota;
        $competitionSlot->competition -> update([
            'temp_quota' => $remainedParticipant - $competitionSlot->quantity,
        ]);

        $confirmedMail = [
            'subject' => $competitionSlot->competition->name. " - Confirmed Slot",
            'name'=>$competitionSlot->competition->name,
            'body1'=>'We are grateful to inform you that your slot registration has been confirmed.',
            'body2'=>'Please proceed to the payment for your slot by clicking the button below.',
            'url' => 'http://aeo.mybnec.org/dashboard/step-2'

        ];
        Mail::to($competitionSlot->user->email)->send(new ConfirmedSlotMail($confirmedMail));
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

    public function reject (Request $request){
        //admin kasi alasan kenapa di reject
        $competitionSlot = CompetitionSlot::find($request->slot);
        $competitionSlot ->update([
            'updated_by' => 'Admin',
            'is_confirmed' => -1
        ]);

        $rejectMail = [
            'subject' => $competitionSlot->competition->name. " - Rejection Slot",
            'name'=>$competitionSlot->competition->name,
            'body1'=>'We are regretful to inform you that your competition slot has been rejected with the following reason: ',
            'body2'=>'You can edit your slot registration again by going into the registration step on our website.',
            'reason' => $request->reason,
            'url' => 'http://aeo.mybnec.org/dashboard/step-1'

        ];
        Mail::to($competitionSlot->user->email)->send(new RejectionMail($rejectMail));
        return redirect()->route('slot-registrations.index');

        

        return redirect()->route('slot-registrations.index');
    }
    
    public function update(Request $request, $id){
        $competitionSlot = CompetitionSlot::find($id);
        $validation = $this->checkSlotAvailability($request->quantity,$request->compet_id);
        if($validation != 'true')return redirect()->back()->with('error',$validation);
        
        if($competitionSlot->is_confirmed == 1) return redirect()->back()->with('error','Sorry, the updates is failed');
        

        // cari selisih quantity 
        $difference = $competitionSlot->quantity - $request->quantity ;
        //update competition slot table
        $competitionSlot->update([
            'quantity' => $request->quantity,
            'is_confirmed' => 0
        ]);
        
        $competition = Competition::find($competitionSlot->competition->id);
        $remainedQuota = $competition->temp_quota;
        //update competition table (temp quota) 
        $competition->update([
            'temp_quota' => $remainedQuota + $difference
        ]);
        if (Auth::guard('admin')->check()) return redirect()->back()->with('success',"Slot's quantity is successfully updated");

        return redirect()->route('dashboard.step',1)->with('success',"Slot's quantity is successfully updated");
    }
    
    
    public function destroy($id){
        $competitionSlot = CompetitionSlot::find($id);
        $competitionSlot->delete();
        return redirect()->route('dashboard.step',1)->with('success',"The Slot is successfully deleted");
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Competition;
use Illuminate\Http\Request;
use App\Models\CompetitionSlot;
use App\Models\CompetitionTeam;
use Illuminate\Support\Facades\Auth;
use App\Models\CompetitionParticipant;
use App\Models\CompetitionScore;
use App\Models\ScoreType;

class UserCompetitionParticipantController extends Controller
{
    public function __construct(){
        $this->middleware('auth', 'verified');
        $this->middleware('IsShowed:ENV008');
    }

    public function index($competition){
        $trashed = CompetitionParticipant::onlyTrashed()->get();
        // dd($competitionParticipants);
        return view('competition-participants.index',[
            'competitionParticipants'=> CompetitionParticipant::where('competition_id',$competition)->get(),
            'competition' => Competition::find($competition),
            // 'trashed' => $trashed,
        ]);
    }

    public function show($user, $id){
        $competition = Competition::find($id);
        $competitionParticipants = CompetitionParticipant::where('pic_id',$user)
                                    ->where('competition_id',$id);
  
        return view('competition-participants.show',[
            'competitionParticipants' => $competitionParticipants->get(),
        ]);
    }
            
        
    public function create(CompetitionSlot $competitionParticipant){
        if ($competitionParticipant->payment == NULL)return redirect()->back()->with('error','Please make payment first');
        if($competitionParticipant->payment->is_confirmed != 1 )return redirect()->back()->with('error','Please wait for the confirmation to be confirmed');

        if ($competitionParticipant->competition->need_team){
            $totalTeams = CompetitionSlot::join('competition_participants', 'competition_participants.competition_slot_id', 'competition_slot_details.id')
                ->join('competitions', 'competitions.id', 'competition_slot_details.competition_id')
                ->where ('competitions.name',$competitionParticipant->competition->name)
                ->distinct('team_id')
                ->count();

            // dd($totalTeams);

            return view('competition-participants.create-team',[
                'competitionSlot' =>$competitionParticipant ,
                'quantity' => $competitionParticipant->quantity,
                'totalTeams' => $totalTeams,
            ]);
        }

        return view('competition-participants.create-single',[
            'competitionSlot' =>$competitionParticipant ,
            'quantity' => $competitionParticipant->quantity
        ]);
        
    }

    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'nama.*' => 'nullable|string|distinct',
            'email.*' => 'nullable|string|unique:competition_participants,email|distinct',
            'gender.*' => 'nullable',
            'phone.*' => 'nullable|numeric|distinct',
            'birth.*' => 'nullable|date_format:Y-m-d',
            'profile_picture.*' => 'nullable|image|max:1999|mimes:jpeg,jpg,png',
        ],
        // customize error
        [
            'nama.*' => 'name must be distinct '
        ]);

      
        $competition = Competition::find($request->competition_id);    
        $len = $request->quantity;
        if($request->total_teams){
            $index = 0 ;
            for ($i = 0 ; $i < $len ; $i++){
                $numberOfParticipant = 'people'.$i+$request->total_teams;
                // dd($numberOfParticipant);
                $team_id = CompetitionTeam::create([
                    'created_by'=> Auth::user()->username,
                    'name' => $request->team_name[$i],
                    'competition_id' => $request->competition_id,
                ]);

                if ($competition->id == 'DB') $amountOfParticipant = 2;
                elseif($competition->id == 'RD') $amountOfParticipant = 5; 
                for( $j = 0 ; $j < $amountOfParticipant ; $j++){
                    if ($request->nama[$index] == NULL){
                        $index++;
                        continue;
                    };

                    $name= $request->nama[$index];
                    $fileName = str_replace(' ', '-', $name);
                    $fileName = preg_replace('/[^A-Za-z0-9\-]/', '', $fileName);
                    $fileName = str_replace('-', '_', $fileName);
                    $current = time();
            
                    if($request->hasFile('profile_picture.'.$index)){
                        $extension = $request->file('profile_picture.'.$index)->getClientOriginalExtension();
                        $fixedName = $fileName.'_'.$current.'.'.$extension;
                        $path = $request->file("profile_picture.".$index)->storeAs("public/profile_picture/".$request->competition_id,$fixedName);
                    }
            
                    $newParticipant = CompetitionParticipant::create([
                        'team_id' => $team_id->id,
                        'created_by' => Auth::user()->username,
                        'pic_id' => Auth::user()->id,
                        'competition_slot_id' =>$request->competition_slot_id,
                        'competition_id' =>$request->competition_id,
                        'is_novice_debater' => 0,
                        'name' =>$request->nama[$index],
                        'email' =>$request->email[$index],
                        'gender' =>$request->gender[$index],
                        'phone_number' =>$request->phone[$index],
                        'birth_date' =>$request->birth[$index],
                        'profile_picture' =>$fixedName,
                        'is_vegetarian' =>0,
                        'is_attend' => 0,
                    ]);
                    if ($newParticipant) {
                        CompetitionScore::create([
                            'created_by' => Auth::user()->username,
                            'participant_id' => $newParticipant->id,
                            'score_type_id' => ScoreType::min('id')
                        ]);
                    }
                }
            }
        }
        else {
            for($i = 0; $i < $len; $i++ ){
                $name= $request->nama[$i];
                $fileName = str_replace(' ', '-', $name);
                $fileName = preg_replace('/[^A-Za-z0-9\-]/', '', $fileName);
                $fileName = str_replace('-', '_', $fileName);
                $current = time();
        
                if($request->hasFile('profile_picture.'.$i)){
                    $extension = $request->file('profile_picture.'.$i)->getClientOriginalExtension();
                    $fixedName = $fileName.'_'.$current.'.'.$extension;
                    $path = $request->file("profile_picture.".$i)->storeAs("public/profile_picture/".$request->competition_id,$fixedName);
                }
    
                $newParticipant = CompetitionParticipant::create([
                    'created_by' => Auth::user()->username,
                    'pic_id' => Auth::user()->id,
                    'competition_slot_id' =>$request->competition_slot_id,
                    'competition_id' =>$request->competition_id,
                    'is_novice_debater' => 0,
                    'name' =>$request->nama[$i],
                    'email' =>$request->email[$i],
                    'gender' =>$request->gender[$i],
                    'phone_number' =>$request->phone[$i],
                    'birth_date' =>$request->birth[$i],
                    'profile_picture' =>$fixedName,
                    'is_vegetarian' =>0,
                    'is_attend' => 0,
                ]);

                if ($newParticipant) {
                    CompetitionScore::create([
                        'created_by' => Auth::user()->username,
                        'participant_id' => $newParticipant->id,
                        'score_type_id' => ScoreType::min('id')
                    ]);
                }
            }
        }
        return redirect()->route('dashboard.step',3)->with('success','Participant successfully registered');
    }
}

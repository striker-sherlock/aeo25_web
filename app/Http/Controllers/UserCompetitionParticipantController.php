<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Competition;
use Illuminate\Http\Request;
use App\Models\CompetitionSlot;
use App\Models\CompetitionTeam;
use Illuminate\Support\Facades\Auth;
use App\Models\CompetitionParticipant;

class UserCompetitionParticipantController extends Controller
{
    public function index($competition){
        
        // dd($competitionParticipants);
        return view('competition-participants.index',[
            'competitionParticipants'=> CompetitionParticipant::where('competition_id',$competition)->get(),
            'competition' => Competition::find($competition),
        
        ]);
    }

    public function create(CompetitionSlot $competitionParticipant){
        // dd($competitionParticipant->competitionParticipant);
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
     
        $request->validate([
            'nama' => 'required|distinct',
            'email' => 'required|distinct',
            'phone' => 'required|distinct',
            'nama.*' => 'required|string',
            'email.*' => 'required|string|unique:competition_participants,email',
            'gender.*' => 'required|string',
            'phone.*' => 'required|numeric',
            'birth.*' => 'required|date_format:Y-m-d',
            'profile_picture.*' => 'required|image|max:1999|mimes:jpeg,jpg,png',
        ],
        // ccustom error
        [
            'nama.*' => ''
        ]);
        $len = $request->quantity;
        $index =0 ;
        for ($i =0 ; $i < $len ; $i++){
            $team_id = CompetitionTeam::create([
                'created_by'=> Auth::user()->username,
                'name' => $request->team_name[$i],
                'competition_id' => $request->competition_id,
            ]);
            
              
            $amountOfParticipant = $request->team_participant[$i];
            for( $j = 0 ; $j < $amountOfParticipant ; $j++){
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
          
                $participant = CompetitionParticipant::create([
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
                $index++;
            }

        }    
        return redirect()->route('dashboard.step',3)->with('success','Participant successfuly registered');

    }
}

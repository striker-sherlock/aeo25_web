<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\CompetitionParticipant;
use App\Models\CompetitionScore;
use App\Models\CompetitionTeam;
use App\Models\ScoreType;
use Illuminate\Http\Request;

class RankingListController extends Controller
{
   

    public function index(Competition $competition, $scoreTypeName)
    {
        $scoreType = $this->getScoreType($scoreTypeName);

        if ($competition->need_team) {
            $rankingLists = CompetitionScore::join('competition_participants', 'competition_participants.id', 'competition_scores.participant_id')
                ->join('competition_teams', 'competition_teams.id', 'competition_participants.team_id')
                ->join('competition_slot_details', 'competition_participants.competition_slot_id', 'competition_slot_details.id')
                ->join('users', 'users.id', 'competition_slot_details.pic_id')
                ->where('competition_participants.competition_id', $competition->id)
                ->where('competition_scores.score_type_id', $scoreType->id)
                ->whereNull('competition_participants.deleted_at') //! jgn lupa di uncomment kalo column deleted_at udah dibuat
                ->select(
                    'competition_scores.id',
                    'competition_participants.team_id',
                    'competition_participants.id as participant_id',
                    'competition_teams.name as team_name',
                    'competition_participants.name as participant_name',
                    'users.institution_name',
                    'competition_scores.score_type_id as participant_score_type_id',
                    'competition_participants.rank_id as participant_rank_id',
                    'competition_participants.is_novice_debater',
                    'competition_scores.score'
                )
                ->orderby('score', 'DESC')
                ->get()
                ->groupBy('team_id');
            foreach ($rankingLists as $rankingList) {
                foreach ($rankingList as $ranking) {
                    $ranking->participant_name .= '<br>';
                }
            }
        }else {
            $rankingLists = CompetitionScore::join('competition_participants', 'competition_participants.id', 'competition_scores.participant_id')
                ->join('competition_slot_details', 'competition_participants.competition_slot_id', 'competition_slot_details.id')
                ->join('users', 'users.id', 'competition_slot_details.pic_id')
                ->where('competition_participants.competition_id', $competition->id)
                ->where('competition_scores.score_type_id', $scoreType->id)
                ->whereNull('competition_participants.deleted_at') //! jgn lupa di uncomment kalo column deleted_at udah dibuat
                ->select(
                    'competition_scores.id',
                    'competition_participants.id as participant_id',
                    'competition_participants.name as participant_name',
                    'users.institution_name',
                    'competition_scores.score_type_id as participant_score_type_id',
                    'competition_participants.rank_id as participant_rank_id',
                    'competition_scores.score'
                )
                ->orderby('score', 'DESC')
                ->get();
            
        }
        return view('ranking-lists.index', [
            'rankingLists' => $rankingLists,
            'selectedField' => $competition,
            'selectedType' => $scoreType,
            'scoreTypes' => $this->getScoreTypeNames(),
            'competitions' => Competition::where('id' , '<>', 'IA')->orderby('name')->get()
        ]); 
    }

    public function manage (Competition $competition, $scoreTypeName)
    {
        $scoreType = $this->getScoreType($scoreTypeName);

        if ($competition->need_team) {
            $rankingLists = CompetitionScore::join('competition_participants', 'competition_participants.id', 'competition_scores.participant_id')
                ->join('competition_teams', 'competition_teams.id', 'competition_participants.team_id')
                ->join('competition_slot_details', 'competition_participants.competition_slot_id', 'competition_slot_details.id')
                ->join('users', 'users.id', 'competition_slot_details.pic_id')
                ->where('competition_participants.competition_id', $competition->id)
                ->where('competition_scores.score_type_id', $scoreType->id)
                ->whereNull('competition_participants.deleted_at') //! jgn lupa di uncomment kalo column deleted_at udah dibuat
                ->select(
                    'competition_scores.id',
                    'competition_participants.team_id',
                    'competition_participants.id as participant_id',
                    'competition_teams.name as team_name',
                    'competition_participants.name as participant_name',
                    'users.institution_name',
                    'competition_scores.score_type_id as participant_score_type_id',
                    'competition_participants.rank_id as participant_rank_id',
                    'competition_participants.is_novice_debater',
                    'competition_scores.score'
                )
                ->orderby('score', 'DESC')
                ->get()
                ->groupBy('team_id');
            foreach ($rankingLists as $rankingList) {
                foreach ($rankingList as $ranking) {
                    $ranking->participant_name .= '<br>';
                    $rankingList->status = $this->getParticipantScoreStatus(
                        $rankingList[0]->participant_id, 
                        $scoreType->id,
                        $competition->id
                    );
                }
            }
        }else {
            $rankingLists = CompetitionScore::join('competition_participants', 'competition_participants.id', 'competition_scores.participant_id')
                ->join('competition_slot_details', 'competition_participants.competition_slot_id', 'competition_slot_details.id')
                ->join('users', 'users.id', 'competition_slot_details.pic_id')
                ->where('competition_participants.competition_id', $competition->id)
                ->where('competition_scores.score_type_id', $scoreType->id)
                ->whereNull('competition_participants.deleted_at') //! jgn lupa di uncomment kalo column deleted_at udah dibuat
                ->select(
                    'competition_scores.id',
                    'competition_participants.id as participant_id',
                    'competition_participants.name as participant_name',
                    'users.institution_name',
                    'competition_scores.score_type_id as participant_score_type_id',
                    'competition_participants.rank_id as participant_rank_id',
                    'competition_scores.score'
                )
                ->orderby('score', 'DESC')
                ->get();
            foreach($rankingLists as $rankingList){
                $rankingList->status = $this->getParticipantScoreStatus(
                        $rankingList->participant_id, 
                        $scoreType->id,
                        $competition->id
                    );
            }
        }
        return view('ranking-lists.manage', [
            'rankingLists' => $rankingLists,
            'selectedField' => $competition,
            'selectedType' => $scoreType,
            'scoreTypes' => $this->getScoreTypeNames(),
            'competitions' => Competition::where('id' , '<>', 'IA')->orderby('name')->get()
        ]); 
    }

    public function updateScoreType (CompetitionScore $competitionScore, $type)
    {
        $competitionParticipant = CompetitionParticipant::where('id', $competitionScore->participant_id)->first();

        if (strtolower($type) === "down") {
            if ($competitionScore->score_type_id == 1) return redirect()->back()->with('error', 'Participant already in Preliminary Round!');
            
            if ($competitionParticipant->rank_id <= 5) {
                $competitionScore->delete();
            }

            if ($competitionParticipant->competition_id === "DB" && $competitionScore->score_type_id == 3) {
                $decrementRank = 1;
            }else if ($competitionScore->score_type_id == 3) {
                $decrementRank = 3;
            }else if ($competitionScore->score_type_id != 3) {
                $decrementRank = 1;
            }

            $competitionParticipant->update([
                'updated_by' => 'Admin',
                'rank_id' => $competitionParticipant->rank_id - $decrementRank
            ]);
            
            return redirect()->back()->with('success', 'Participant status updated successfully!');
        }

        if ($competitionParticipant->competition_id === "DB" && $competitionScore->score_type_id == 1) {
            $amount = 1;
        }else if($competitionScore->score_type_id == 1) {
            $amount = 2;
        }else if ($competitionScore->score_type_id > 1) {
            $amount = 1;
        }

        $newScoreType = ScoreType::find($competitionScore->score_type_id + $amount);

        if ($newScoreType) {
            if (CompetitionScore::where([['participant_id', $competitionParticipant->id], ['score_type_id', $newScoreType->id]])->first()) 
                return redirect()->back()->with('error', "Participant already in " . $newScoreType->type_name . "!");

            CompetitionScore::create([
                'created_by' => 'Admin',
                'participant_id' => $competitionScore->participant_id,
                'score_type_id' => $newScoreType->id
            ]);

            $competitionParticipant->update([
                'updated_by' => 'Admin',
                'rank_id' => $newScoreType->id
            ]);

        }else {
            if ($competitionParticipant->rank_id >= 5) {
                $competitionParticipant->update([
                    'updated_by' => 'Admin',
                    'rank_id' => $competitionParticipant->rank_id + 1
                ]);
                return redirect()->back()->with('success', 'Participant status updated successfully!');
            }
            return redirect()->back()->with('error', 'Undefined Score Type!');
        }
        
        return redirect()->back()->with('success', 'Participant status updated successfully!');
    }

    public function updateTeamScoreType (CompetitionTeam $competitionTeam, ScoreType $scoreType, $type) 
    {
        //! ambil dulu ID participant yg ada di team yang mau diupdate scorenya
        $competitionParticipants = CompetitionParticipant::where('team_id', $competitionTeam->id)->get(); 
        $currentRank = $competitionParticipants[0]->rank_id;

        //! ambil data score participant yg sesuai dengan ID participant yg udh diambil dan sesuai dengan Score Type yg mau diupdate
        $competitionScores = CompetitionScore::whereIn('participant_id', $competitionParticipants->pluck('id'))->where('score_type_id', $scoreType->id)->get(); 
        
        if (strtolower($type) === "down") {
            if ($scoreType->id == 1) return redirect()->back()->with('error', 'Participant already in Preliminary Round!');
            
            foreach ($competitionScores as $competitionScore) {
                if($currentRank <= 5) {
                    $competitionScore->delete();
                }
    
                if ($competitionTeam->competition_id === "DB" && $competitionScore->score_type_id == 3) {
                    $decrementRank = 1;
                }else if ($competitionScore->score_type_id == 3) {
                    $decrementRank = 3;
                }else if ($competitionScore->score_type_id != 3) {
                    $decrementRank = 1;
                }

                foreach($competitionParticipants as $competitionParticipant) {
                    $competitionParticipant->update([
                        'updated_by' => 'Admin',
                        'rank_id' => $currentRank - $decrementRank
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Participant status updated successfully!');
        }

        if ($competitionTeam->competition_id === "DB" && $scoreType->id == 1) {
            $amount = 1;
        }else if($scoreType->id == 1) {
            $amount = 2;
        }else if ($scoreType->id > 1) {
            $amount = 1;
        }

        $newScoreType = ScoreType::find($scoreType->id + $amount);

        if ($newScoreType) {
            foreach ($competitionParticipants as $competitionParticipant) {
                if (CompetitionScore::where([['participant_id', $competitionParticipant->id], ['score_type_id', $newScoreType->id]])->first()) 
                    return redirect()->back()->with('error', "Participant already in " . $newScoreType->type_name . "!");
                    
                    CompetitionScore::create([
                        'created_by' => 'Admin',
                        'participant_id' => $competitionParticipant->id,
                        'score_type_id' => $newScoreType->id
                    ]);
                    $competitionParticipant->update([
                        'updated_by' => 'Admin',
                        'rank_id' => $newScoreType->id
                    ]);
                }
                return redirect()->back()->with('success', 'Team status updated successfully!');
        }else {
            foreach($competitionParticipants as $competitionParticipant) {
                if ($competitionParticipant->rank_id >= 5) {
                    $currentRank = $competitionParticipant->rank_id;
                    $competitionParticipant->update([
                        'updated_by' => 'Admin',
                        'rank_id' => $currentRank + 1
                    ]);
                }
            }
            return redirect()->back()->with('success', 'Team status updated successfully!');
        }
    }

    public function updateTeamScore (Request $request, CompetitionTeam $competitionTeam, ScoreType $scoreType)
    {
        //! ambil dulu ID participant yg ada di team yang mau diupdate scorenya
        $competitionParticipantIds = CompetitionParticipant::where('team_id', $competitionTeam->id)->pluck('id'); 

        //! ambil data score participant yg sesuai dengan ID participant yg udh diambil dan sesuai dengan Score Type yg mau diupdate
        $competitionScores = CompetitionScore::whereIn('participant_id', $competitionParticipantIds)->where('score_type_id', $scoreType->id)->get(); 

        $request->validate([
            'score' => 'required|numeric'
        ]);

        foreach($competitionScores as $competitionScore) {
            $competitionScore->update([
                'updated_by' => 'Admin',
                'score' => $request->score
            ]);
        }
        return redirect()->back()->with('success', 'Team score updated successfully!');
    }

    public function updateScore (Request $request, CompetitionScore $competitionScore)
    {   
        $request->validate([
            'score' => 'required|numeric'
        ]);

        $competitionScore->update([
            'updated_by' => 'Admin',
            'score' => $request->score
        ]);

        return redirect()->back()->with('success', 'Score updated successfully!');
    }

    public function updateDebateType (CompetitionTeam $competitionTeam)
    {
        foreach (CompetitionParticipant::where('team_id', $competitionTeam->id)->get() as $competitionParticipant) {
            $competitionParticipant->update([
                'updated_by' => 'Admin',
                'is_novice_debater' => !$competitionParticipant->is_novice_debater
            ]);
        }
        return redirect()->back()->with('success', 'Debate type updated successfully!');
    }

    private function getScoreType ($scoreTypeName) {
        $scoreTypeName = str_replace('-', ' ', $scoreTypeName);

        $scoreType = ScoreType::where('type_name', 'LIKE', $scoreTypeName)->first();

        return $scoreType;
    }

    private function getScoreTypeNames () {
        $scoreTypeNames = [];

        foreach (ScoreType::orderBy('id')->get() as $scoreType) {
            $temp = (object) [];
            $temp->id = $scoreType->id;
            $temp->scoreTypeName = strtolower(str_replace(' ', '-', $scoreType->type_name));
            $temp->typeName = $scoreType->type_name;
            $scoreTypeNames[] = $temp;
        }

        return $scoreTypeNames;
    }

    private function getScoreTypeName ($scoreTypeId)
    {
        return ScoreType::find($scoreTypeId)->type_name;
    }

    private function getParticipantScoreStatus ($participantId, $currentScoreTypeId, $competitionId)
    {
        $competitionScores = CompetitionScore::where('participant_id', $participantId)->get();
        $competitionParticipant = CompetitionParticipant::where('id', $participantId)->first();
        if (count($competitionScores->where('score_type_id', $currentScoreTypeId + 1)) > 0 || count($competitionScores->where('score_type_id', $currentScoreTypeId + 2)) > 0) {
            $status = "Passed to ";
            if ($competitionId === "DB" && $currentScoreTypeId == 1) {
                $status .= $this->getScoreTypeName($currentScoreTypeId + 1);
            }else if ($currentScoreTypeId == 1) {
                $status .= $this->getScoreTypeName($currentScoreTypeId + 2);
            }else if($currentScoreTypeId > 1){
                $status .= $this->getScoreTypeName($currentScoreTypeId + 1);
            }
        }else {
            $status = "Stay in ";
            $status .= $this->getScoreTypeName($currentScoreTypeId);
        }

        if($currentScoreTypeId == 5){
            // dd($competitionParticipant->rank);
            $status = $competitionParticipant->rank->rank_name;
        }

        return $status;
    }
}

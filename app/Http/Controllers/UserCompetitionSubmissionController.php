<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\CompetitionParticipant;
use App\Models\CompetitionSlot;
use App\Models\CompetitionSubmissions;
use App\Models\CompetitionTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class UserCompetitionSubmissionController extends Controller
{
    public function getUser()
    {
        $user = Auth::user();
        return $user;
    }

    public function create($competitionSlotDetail)
    {

        $slotId = $competitionSlotDetail;
        $competitionSlotDetail = CompetitionSlot::findOrFail($slotId);

        $user = $this->getUser();
        $competition = Competition::where('id', $competitionSlotDetail->competition_id)->first();

        if (time() < strtotime($competition->submission_start)) return redirect()->back()->with('error', 'Submission time is not started yet!');
        
        
        if ($competition->id == "RD") {
            $teams = CompetitionTeam::join('competition_participants', 'competition_participants.team_id', 'competition_teams.id')
                ->join('competition_slot_details', 'competition_slot_details.id', 'competition_participants.competition_slot_id')
                ->select(
                    'competition_teams.id as id',
                    'competition_teams.name as name',
                    'competition_participants.name as member_name',
                    'competition_participants.team_id as team_id',
                    'competition_participants.gender as gender',
                    'competition_participants.email as email',
                    'competition_participants.phone_number as phone'
                )
                ->where('competition_teams.competition_id', $competition->id)
                ->where('competition_slot_id', $competitionSlotDetail->id)
                ->get();
            return view('competition-submissions.create', [
                'quantity' => $competitionSlotDetail->quantity,
                'competition' => $competition,
                'submitters' => $teams->unique(),
                'members' => $teams,
                'submissionCounter' => CompetitionSubmissions::whereIn('submitter_id', $teams->pluck('id'))->where('competition_id', $competition->id)->count()
            ]);
        } else {
            $participants = CompetitionParticipant::where('competition_slot_id', $competitionSlotDetail->id)->pluck('id');
            if ($participants->count() == 0 ) return redirect()->back()->with('error','You have to register the participant first');
            return view('competition-submissions.create', [
                'competition' => $competition,
                'submitters' => CompetitionParticipant::where('competition_slot_id', $competitionSlotDetail->id)->latest('created_at')->get(),
                'submissionCounter' => CompetitionSubmissions::whereIn('submitter_id', $participants)->where('competition_id', $competition->id)->count()
            ]);
        }
    }

    public function validateRequest(Request $request)
    {
        $request->validate([
            'submitter_id' => 'required|integer',
            'title' => 'required|string',
            'submission_link' => 'required|string'
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        CompetitionSubmissions::create([
            'competition_id' => request('competition_id'),
            'submitter_id' => request('submitter_id'),
            'title' => request('title'),
            'submission_link' => request('submission_link'),
            'created_by' => Auth::user()->username,
        ]);
        return redirect()->route('dashboard.step', 4)->with('success', 'Congratulations! Your work has been submitted!');

    }
    
}

<?php

namespace App\Http\Controllers;

use App\Exports\CompetitionSubmissionExport;
use App\Models\Competition;
use App\Models\CompetitionParticipant;
use App\Models\CompetitionSubmissions;
use App\Models\CompetitionTeam;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminCompetitionSubmissionController extends Controller
{
    public function __construct(){
        $this->middleware('IsAdmin')->only(['index']);
        $this->middleware('Access:7')->only(['index']);
    }

    public function index (Competition $competition){
        if ($competition->need_submission) {
            if ($competition->id == "SSW") {
                $unpaidSubmissions = CompetitionParticipant::join('competition_submissions', 'competition_submissions.submitter_id', 'competition_participants.id')
                        ->join ('competition_slot_details', 'competition_slot_details.id', 'competition_participants.competition_slot_id')
                        ->join ('users', 'users.id', 'competition_slot_details.pic_id')
                        ->where('competition_submissions.competition_id', $competition->id)
                        ->where('competition_submissions.deleted_at', NULL)
                        ->whereNull('competition_slot_details.payment_id')
                        ->select(
                            'users.id as institution_id',
                            'users.institution_name as institution_name',
                            'competition_participants.name as name',
                            'users.pic_name as pic_name',
                            'users.email as pic_email',
                            'users.pic_phone_number as pic_phone',
                        )
                        ->get();
            }else if ($competition->id == "RD") {
                $unpaidSubmissions = CompetitionTeam::join('competition_submissions', 'competition_submissions.submitter_id', 'competition_teams.id')
                        ->join ('competition_participants', 'competition_participants.team_id', 'competition_teams.id')
                        ->join ('competition_slot_details', 'competition_slot_details.id', 'competition_participants.competition_slot_id')
                        ->join ('users', 'users.id', 'competition_slot_details.pic_id')
                        ->where('competition_submissions.competition_id', $competition->id)
                        ->where('competition_submissions.deleted_at', NULL)
                        ->whereNull('competition_slot_details.payment_id')
                        ->select(
                            'users.id as institution_id',
                            'users.institution_name as institution_name',
                            'competition_teams.name as name',
                            'users.pic_name as pic_name',
                            'users.email as pic_email',
                            'users.pic_phone_number as pic_phone',
                        )
                        ->distinct()
                        ->get();
            }

            if ($competition->is_team) {
                return view('competition-submissions.index', [
                    'competition' => $competition,
                    'unpaidSubmissions' => $unpaidSubmissions ?? NULL,
                    'submittedParticipants' => CompetitionTeam::join('competition_submissions', 'competition_submissions.submitter_id', 'competition_teams.id')
                        ->join ('competition_participants', 'competition_participants.team_id', 'competition_teams.id')
                        ->join ('competition_slot_details', 'competition_slot_details.id', 'competition_participants.competition_slot_id')
                        ->join('competition_payments', 'competition_payments.id', 'competition_slot_details.payment_id')
                        ->join ('users', 'users.id', 'competition_slot_details.pic_id')
                        ->join ('countries', 'users.country_id', 'countries.id')
                        ->where('competition_submissions.competition_id', $competition->id)
                        ->where('competition_submissions.deleted_at', NULL)
                        ->whereNotNull('competition_slot_details.payment_id')
                        ->where('competition_payments.is_confirmed', 1)
                        ->select(
                            'competition_teams.name as name',
                            'users.pic_name as pic_name',
                            'users.institution_name as institution_name',
                            'countries.name as country_name',
                            'competition_submissions.id as submission_id',
                            'competition_submissions.created_at as created_at',
                        )
                        ->distinct()
                        ->get(),
                    'notSubmittedParticipants' => CompetitionTeam::whereNotIn('competition_teams.id', function($query) use($competition) {
                            $query->select('submitter_id')->from('competition_submissions')->where('competition_id', $competition->id);
                        })
                        ->join ('competition_participants', 'competition_participants.team_id', 'competition_teams.id')
                        ->join ('competition_slot_details', 'competition_slot_details.id', 'competition_participants.competition_slot_id')
                        ->join ('users', 'users.id', 'competition_slot_details.pic_id')
                        ->join ('countries', 'users.country_id', 'countries.id')
                        ->withoutTrashed()
                        ->where ('competition_slot_details.competition_id', $competition->id)
                        ->select(
                            'competition_teams.name as name',
                            'competition_teams.id as id',
                            'users.pic_name as pic_name',
                            'users.institution_name as institution_name',
                            'countries.name as country_name'
                        )
                        ->distinct()
                        ->get(),
                    'deletedSubmissions' => CompetitionTeam::join('competition_submissions', 'competition_submissions.submitter_id', 'competition_teams.id')
                        ->join ('competition_participants', 'competition_participants.team_id', 'competition_teams.id')
                        ->join ('competition_slot_details', 'competition_slot_details.id', 'competition_participants.competition_slot_id')
                        ->join ('users', 'users.id', 'competition_slot_details.pic_id')
                        ->join ('countries', 'users.country_id', 'countries.id')
                        ->where('competition_submissions.competition_id', $competition->id)
                        ->where('competition_submissions.deleted_at', '<>' ,NULL)
                        ->select(
                            'competition_teams.name as name',
                            'users.pic_name as pic_name',
                            'users.institution_name as institution_name',
                            'countries.name as country_name',
                            'competition_submissions.id as submission_id',
                            'competition_submissions.created_at as created_at',
                        )
                        ->distinct()
                        ->get(),
                ]);
            }else {
                return view('competition-submissions.index', [
                    'competition' => $competition,
                    'unpaidSubmissions' => $unpaidSubmissions ?? NULL,
                    'submittedParticipants' => CompetitionParticipant::join('competition_submissions', 'competition_submissions.submitter_id', 'competition_participants.id')
                        ->join ('competition_slot_details', 'competition_slot_details.id', 'competition_participants.competition_slot_id')
                        ->join('competition_payments', 'competition_payments.id', 'competition_slot_details.payment_id')
                        ->join ('users', 'users.id', 'competition_slot_details.pic_id')
                        ->join ('countries', 'users.country_id', 'countries.id')
                        ->where('competition_submissions.competition_id', $competition->id)
                        ->where('competition_submissions.deleted_at', NULL)
                        ->whereNotNull('competition_slot_details.payment_id')
                        ->where('competition_payments.is_confirmed', 1)
                        ->select(
                            'competition_participants.id as participant_id',
                            'competition_participants.name as name',
                            'users.pic_name as pic_name',
                            'users.institution_name as institution_name',
                            'countries.name as country_name',
                            'competition_submissions.id as submission_id',
                            'competition_submissions.created_at as created_at',
                        )
                        ->get(),
                    'notSubmittedParticipants' => CompetitionParticipant::whereNotIn('competition_participants.id', function($query) use($competition) {
                            $query->select('submitter_id')->from('competition_submissions')->where('competition_id', $competition->id);
                        })
                        ->join ('competition_slot_details', 'competition_slot_details.id', 'competition_participants.competition_slot_id')
                        ->join ('users', 'users.id', 'competition_slot_details.pic_id')
                        ->join ('countries', 'users.country_id', 'countries.id')
                        ->withoutTrashed()
                        ->where('competition_slot_details.competition_id', $competition->id)
                        ->select(
                            'competition_participants.id as participant_id',
                            'competition_participants.name as name',
                            'competition_participants.id as id',
                            'users.pic_name as pic_name',
                            'users.institution_name as institution_name',
                            'countries.name as country_name'
                        )
                        ->get(),
                    'deletedSubmissions' => CompetitionParticipant::join('competition_submissions', 'competition_submissions.submitter_id', 'competition_participants.id')
                        ->join ('competition_slot_details', 'competition_slot_details.id', 'competition_participants.competition_slot_id')
                        ->join ('users', 'users.id', 'competition_slot_details.pic_id')
                        ->join ('countries', 'users.country_id', 'countries.id')
                        ->where('competition_submissions.competition_id', $competition->id)
                        ->where('competition_submissions.deleted_at', '<>' ,NULL)
                        ->select(
                            'competition_participants.name as name',
                            'users.pic_name as pic_name',
                            'users.institution_name as institution_name',
                            'countries.name as country_name',
                            'competition_submissions.id as submission_id',
                            'competition_submissions.deleted_at as deleted_at'
                        )
                        ->get()
                ]);
            }
        }else {
            return redirect()->back()->with('error', 'Unauthorized Access!');
        }
    }

    public function show(CompetitionSubmissions $submission)
    {
        return view('competition-submissions.show', [
            'submission' => CompetitionSubmissions::where('id', $submission->id)->with('competition')->with('teamSubmitter')->with('participantSubmitter')->first()
        ]);
    }

    public function destroy(CompetitionSubmissions $submission)
    {
        $submission->delete();

        return redirect()->route('competition-submissions.index', $submission->competition_id)->with('success', 'Submission deleted successfully');
    }

    public function delete ($id)
    {
        CompetitionSubmissions::onlyTrashed()->find($id)->forceDelete();

        return redirect()->back()->with('success', 'Submission deleted successfully');
    }

    
    public function restore($id)
    {
        CompetitionSubmissions::onlyTrashed()->find($id)->restore();

        return redirect()->back()->with('success', 'Submission restored successfully');
    }

    public function export ($submission)
    {
        return Excel::download(new CompetitionSubmissionExport($submission), $submission . ' Submission List ' . date('Y-m-d H:i:s'). '.xlsx');
    }
}

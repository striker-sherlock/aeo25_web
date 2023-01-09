<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competition;
use App\Models\CompetitionParticipant;
use App\Models\SideAchievement;
use Illuminate\Support\Facades\DB;

class SideAchievementController extends Controller
{

    public function __construct()
    {
        
    }

    public function index()
    {
        return view('side-achievements.index', [
            'achievements' => SideAchievement::all()
        ]);
    }

    public function create($fieldName)
    {
        $selectedField = Competition::where('competition_name', $fieldName)->first();
        if(!$selectedField){
            return redirect()->back()
            // ->with('error', 'Field Not Available')
            ;
        }

        return view('side-achievements.create', [
            'competitions' => Competition::where('name', '<>', 'Adjudicator')->orderby('name')->get(),
            'competitionParticipants' => DB::table('competition_participants')
                ->join('competition_slot_details', 'competition_participants.competition_slot_id', '=', 'competition_slot_details.id')
                ->join('competitions', 'competition_slot_details.competition_id', '=', 'competitions.id')
                ->select(
                    'competition_participants.id',
                    'competition_participants.name',
                )
                ->where('competitions.id', '=', $selectedField->id)->get(),
            'selectedField' => $selectedField
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'participant_id'=>'required|integer',
            'name' => 'required|string',
        ]);

        SideAchievement::create([
            'participant_id' => $request->participant_id,
            'name' => $request->name,
        ]);
        return redirect()->route('side-achievements.index')->with('success', 'Data Successfully Added');
    }

    public function destroy(SideAchievement $sideAchievement)
    {
        $sideAchievement->forceDelete();
        return redirect()->back()->with('success', 'Successfully Deleted');
    }
}

<?php

namespace App\Exports;

use App\Models\CompetitionPartipant;
use App\Models\CompetitionParticipant;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ParticipantExport implements FromCollection
{

    public function __construct($competition){
        $this->competition = $competition;
    }

    public function collection()
    {
        // dd($this->competition);
        $participants = CompetitionParticipant::join('users','competition_participants.pic_id','users.id')
                    ->join('competitions','competition_participants.competition_id','competitions.id')
                    ->where('competition_participants.competition_id',$this->competition)
                    ->select(
                        'pic_name',
                        'competition_participants.name as nama',
                        'competitions.name as competition',
                        'institution_name',
                        'competition_participants.email as email',
                        'is_vegetarian',
                        'phone_number' 
                    )
                    ->get();
        foreach($participants as $participant){
            if($participant->is_vegetarian == 1) $participant->is_binusian = "VEGETARIAN";
            else $participant->is_vegetarian = "NOT VEGETARIAN";
        }
        return $participants;
    }
}

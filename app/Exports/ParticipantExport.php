<?php

namespace App\Exports;

use App\Models\CompetitionParticipant;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ParticipantExport implements FromCollection, WithHeadings,ShouldAutoSize
{

    public function __construct($competition){
        $this->competition = $competition;
    }

    public function collection()
    {
        if ($this->competition == 'ALL'){
            $participants = CompetitionParticipant::join('users','competition_participants.pic_id','users.id')
            ->join('competitions','competition_participants.competition_id','competitions.id')
            ->select(
                'users.pic_name',
                'competition_participants.name as nama',
                'competitions.name as competition',
                'users.institution_name',
                'competition_participants.email as email',
                'competition_participants.is_vegetarian',
                'competition_participants.food_allergic',
                'competition_participants.gender',
                'competition_participants.birth_date',
                'phone_number' 
            )
            ->orderBy('competition_participants.is_vegetarian')
            ->get(); 
        }
        else{
            $participants = CompetitionParticipant::join('users','competition_participants.pic_id','users.id')
            ->join('competitions','competition_participants.competition_id','competitions.id')
            ->where('competition_participants.competition_id',$this->competition)
            ->select(
                'users.pic_name',
                'competition_participants.name as nama',
                'competitions.name as competition',
                'users.institution_name',
                'competition_participants.email as email',
                'competition_participants.is_vegetarian',
                'competition_participants.food_allergic',
                'competition_participants.gender',
                'competition_participants.birth_date',
                'phone_number' 
            )
            ->get();
        }
        foreach($participants as $participant){
            if($participant->is_vegetarian == "1") $participant->is_vegetarian = "VEGETARIAN";
            else $participant->is_vegetarian = "NOT VEGETARIAN";
        }

        return $participants;
    }
    public function headings():array{
        return ["PIC", "Name", "Field", "Institution" ,"Email", "Vegetarian Status", "Food Allergic", "Gender", "Birth Date", "Phone Number"];
    }

}

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
                'competition_participants.id as participant_ID',
                'competitions.id as competition_id',
                'users.pic_name',
                'competition_participants.name as nama',
                'competitions.name as competition',
                'users.institution_name',
                'competition_participants.email as email',
                'competition_participants.is_vegetarian',
                'competition_participants.food_allergic',
                'competition_participants.gender',
                'competition_participants.birth_date',
                'phone_number',
                'competition_participants.profile_picture'
            )
            ->get(); 
        }
        else{
            $participants = CompetitionParticipant::join('users','competition_participants.pic_id','users.id')
            ->join('competitions','competition_participants.competition_id','competitions.id')
            ->where('competition_participants.competition_id',$this->competition)
            ->select(
                'competition_participants.id as participant_ID',
                'competitions.id as competition_id',
                'users.pic_name',
                'competition_participants.name as nama',
                'competitions.name as competition',
                'users.institution_name',
                'competition_participants.email as email',
                'competition_participants.is_vegetarian',
                'competition_participants.food_allergic',
                'competition_participants.gender',
                'competition_participants.birth_date',
                'phone_number',
                'competition_participants.profile_picture'
            )
            ->get();
        }
        foreach($participants as $participant){
            if($participant->is_vegetarian == "1") $participant->is_vegetarian = "VEGETARIAN";
            else $participant->is_vegetarian = "NOT VEGETARIAN";
        }
        foreach($participants as $participant){
            $participant->profile_picture = "https://aeo.mybnec.org/storage/profile_picture/".$participant->competition_id.'/'.$participant->profile_picture;
            
        }

        return $participants;
    }
    public function headings():array{
        return ['Partis ID','Compet ID', "PIC", "Name", "Field", "Institution" ,"Email", "Vegetarian Status", "Food Allergic", "Gender", "Birth Date", "Phone Number", 'Profile Picture'];
    }

}

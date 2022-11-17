<?php

namespace App\Exports;

use App\Models\CompetitionPartipant;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ParticipantExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($competition){
        $this->competition = $competition;
    }

    public function collection()
    {
        dd($this->competition);
        $participant = CompetitionParticipant::where('competition_id',$this->competition)->get();

        return CompetitionPartipant::all();
    }
}

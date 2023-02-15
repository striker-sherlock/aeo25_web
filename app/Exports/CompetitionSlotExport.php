<?php

namespace App\Exports;

use App\Models\CompetitionSlot;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CompetitionSlotExport implements FromCollection, WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = DB::table('competition_slot_details')
            ->join('users','competition_slot_details.pic_id','users.id')
            ->join('competitions','competitions.id','competition_slot_details.competition_id')
            ->join ('countries', 'users.country_id', 'countries.id')
            ->where('competition_slot_details.is_confirmed',1)
            ->orderBy('users.institution_name')
            ->select(
                'users.institution_name',
                'countries.name',
                'users.pic_name',
                'users.pic_phone_number',
                'users.email',
                'competitions.name as competition_name',
                'competition_slot_details.quantity',
            )
            ->get();
        return $data;
    }

    public function headings():array{
        return ['Insitution', 'Country','PIC Name', 'Contact', 'PIC Email', 'Competition', 'Quantity'];
    }
}

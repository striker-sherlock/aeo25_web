<?php

namespace App\Exports;

use App\Models\FlightTicket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FlightTicketExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $data = FlightTicket::select(
            'pic_id',
            'type',
            'airline_name',
            'flight_time',

        )->get();
        return FlightTicket::all();
    }
    public function headings():array{
        return["PIC", "TYPE", "AIRLINE NAME", "FLIGHT TIME"];
    }
}

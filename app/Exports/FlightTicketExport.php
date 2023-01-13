<?php

namespace App\Exports;

use App\Models\FlightTicket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FlightTicketExport implements FromCollection, WithHeadings
{
    public function __construct($type){
        $this->type = $type;
    }

    public function collection()
    {
        if($this->type == "DEPARTURE"){
            $data = FlightTicket::join('users', 'users.id', 'flight_tickets.pic_id')
            ->join('countries', 'users.country_id', 'countries.id')->where('flight_tickets.type', 'DEPARTURE')
            ->select(
                'users.pic_name',
                'countries.name',
                'users.pic_phone_number',
                'users.email',
                'flight_tickets.type',
                'flight_tickets.airline_name',
                'flight_tickets.flight_time',
            )->get();
        }
        else{
            $data = FlightTicket::join('users', 'users.id', 'flight_tickets.pic_id')
            ->join('countries', 'users.country_id', 'countries.id')->where('flight_tickets.type', 'ARRIVAL')
            ->select(
                'users.pic_name',
                'countries.name',
                'users.pic_phone_number',
                'users.email',
                'flight_tickets.type',
                'flight_tickets.airline_name',
                'flight_tickets.flight_time',
            )->get();
        }
        foreach($data as $Data){
            $Data->flight_time = date("F j, Y G:i ", strtotime($Data->flight_time));
        }
        return $data;
    }
    public function headings():array{
        return["PIC NAME", "COUNTRY", "PHONE NUMBER", "EMAIL", "TYPE", "AIRLINE NAME", "FLIGHT TIME"];
    }
}

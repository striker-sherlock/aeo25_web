<?php

namespace App\Exports;

use App\Models\Accommodation;
use App\Models\AccommodationGuest;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AccommodationGuestExport implements FromCollection, WithHeadings,ShouldAutoSize
{
    public function __construct($room){
        $this->room = $room;
    }

    public function collection()
    {
        $roomType = Accommodation::find($this->room);
        if($this->room){
            $guests = AccommodationGuest::join('users', 'accommodation_guests.pic_id', 'users.id')
            ->join('accommodation_slot_details', 'accommodation_guests.accommodation_slot_id', 'accommodation_slot_details.id')
            ->join('accommodations', 'accommodation_guests.accommodation_id', 'accommodations.id')
            ->where('accommodations.room_type',$roomType->room_type)
            ->select(
                'pic_name',
                'institution_name',
                'accommodation_guests.guest_name as name',
                'accommodation_guests.guest_gender as gender',
                'accommodations.room_type',
            )
            ->get();
             return $guests;
        }
        else{
            $guests = AccommodationGuest::join('users', 'accommodation_guests.pic_id', 'users.id')
            ->join('accommodation_slot_details', 'accommodation_guests.accommodation_slot_id', 'accommodation_slot_details.id')
            ->join('accommodations', 'accommodation_guests.accommodation_id', 'accommodations.id')
            ->select(
                'pic_name',
                'institution_name',
                'accommodation_guests.guest_name as name',
                'accommodation_guests.guest_gender as gender',
                'accommodations.room_type',
            )
            ->get();
            return $guests;
        }
       
    }
    public function headings():array{
        return ["PIC Name", "Institution", "Guest Name","Guest Gender", "Room Type"];
    }
}

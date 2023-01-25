<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\Models\AccommodationPayment;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AccommodationPaymentExport implements FromCollection, WithHeadings,ShouldAutoSize
{
    public function collection()
    {
        $data = DB::table('accommodation_payments')
        ->join('users', 'accommodation_payments.pic_id', '=', 'users.id')
        ->join('accommodation_slot_details','accommodation_payments.id', '=', 'accommodation_slot_details.payment_id')
        ->join('accommodations','accommodation_slot_details.accommodation_id', '=', 'accommodations.id')
        ->where('accommodation_payments.is_confirmed', 1)
        ->orderBy('accommodations.room_type')
        ->select(
            'accommodation_payments.id as id',
            'users.pic_name',
            'accommodations.room_type',
            'users.email',
            'users.pic_phone_number',
            'accommodation_payments.account_number',
            'accommodation_payments.amount',
            'accommodation_slot_details.check_in_date',
            'accommodation_slot_details.check_out_date',
            'accommodation_slot_details.quantity',
        )->get();
        foreach ($data as $accountNumber) {
            if ($accountNumber->account_number == null )$accountNumber->account_number = 'Wise';
        }   
        foreach ($data as $date) {
            $date->check_in_date = date("d M",strtotime($date->check_in_date ));
            $date->check_out_date = date("d M",strtotime($date->check_out_date ));
        }   
        return $data;
    }

    public function headings():array{
        return ["ID", "PIC Name","Room Type","PIC Email", "Contact","Account Number", "Amount","Check In Date", "Check Out Date", "Room Quantity"];
    }

}

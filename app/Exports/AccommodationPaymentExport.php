<?php

namespace App\Exports;

use App\Models\AccommodationPayment;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;

class AccommodationPaymentExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $data = DB::table('accommodation_payments')
        ->join('users', 'accommodation_payments.pic_id', '=', 'users.id')->where('is_confirmed', 1)
        ->select(
            'accommodation_payments.id as id',
            'users.pic_name',
            'users.email',
            'users.pic_phone_number',
            'accommodation_payments.account_number',
            'accommodation_payments.amount',
        )->get();
        return $data;
    }

    public function headings():array{
        return ["ID", "PIC Name", "PIC Email", "Contact","Account Number", "Amount"];
    }

}

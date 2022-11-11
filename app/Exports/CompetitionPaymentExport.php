<?php

namespace App\Exports;

use App\Models\CompetitionPayment;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;


class CompetitionPaymentExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = DB::table('competition_payments')
            ->join('users','competition_payments.pic_id', '=', 'users.id')
            ->where('is_confirmed',1) 
            ->select('competition_payments.id as id', 'competition_payments.amount' , 'competition_payments.account_number','users.pic_name','users.email','users.pic_phone_number')
            ->get();
   
        return $data;
        // return redirect()->back();
    }

    public function haedings():array{
        return ['ID', 'Amount','Account_number', 'PIC', 'PIC Email', 'Contact'];
    }
}

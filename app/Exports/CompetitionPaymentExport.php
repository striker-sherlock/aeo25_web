<?php

namespace App\Exports;

use App\Models\CompetitionPayment;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class CompetitionPaymentExport implements FromCollection, WithHeadings,ShouldAutoSize
{
     
    public function __construct ($type){
        $this->type = $type;
    }

    public function collection()
    {   
        if ($this->type == "international"){
            $data = DB::table('competition_payments')
                ->join('users','competition_payments.pic_id', '=', 'users.id')
                ->join('competition_slot_details','competition_payments.id', '=', 'competition_slot_details.payment_id')
                ->join('competitions','competitions.id','competition_slot_details.competition_id')
                ->join ('countries', 'users.country_id', 'countries.id')
                ->join('payment_providers','payment_providers.id','competition_payments.payment_provider_id')
                ->where('countries.name','NOT LIKE','indonesia')
                ->where('competition_payments.is_confirmed',1) 
                ->orderBy('competition_payments.id')
                ->select(
                    'users.pic_name',
                    'users.email',
                    'users.institution_name',
                    'users.institution_email',
                    'countries.name as country_name',
                    'users.pic_phone_number',
                    'payment_providers.name as payment_provider',
                    'competition_payments.id',
                    'competitions.name as competition_name',
                    'competition_slot_details.quantity',
                    'competition_payments.amount' ,
                    )
                ->get();
            foreach ($data as $paymentName) {
                if($paymentName->payment_provider == NULL) $paymentName->payment_provider = 'WISE';
            }
            return $data;
        }

        if ($this->type == "national"){
            $data = DB::table('competition_payments')
                ->join('users','competition_payments.pic_id', '=', 'users.id')
                ->join('competition_slot_details','competition_payments.id', '=', 'competition_slot_details.payment_id')
                ->join('competitions','competitions.id','competition_slot_details.competition_id')
                ->join ('countries', 'users.country_id', 'countries.id')
                ->join('payment_providers','payment_providers.id','competition_payments.payment_provider_id')
                ->where('countries.name','LIKE','indonesia')
                ->where('competition_payments.is_confirmed',1) 
                ->orderBy('competition_payments.id')
                ->select(
                    'users.pic_name',
                    'users.email',
                    'users.institution_name',
                    'users.institution_email',
                    'countries.name as country_name',
                    'users.pic_phone_number',
                    'payment_providers.name as payment_provider',
                    'competition_payments.id',
                    'competitions.name as competition_name',
                    'competition_slot_details.quantity',
                    'competition_payments.amount' ,
                    
                    )
                ->get();
            foreach ($data as $amount){
                $amount->amount = number_format($amount->amount);
            }
            return $data;
        }
        // return redirect()->back();
    }

    public function headings():array{
        return ['PIC', 'PIC Email', 'Institution', 'Institution Email', 'Country', 'Contact', 'Payment Provider','Payment ID' , 'Field',"Quantity", 'Amount'];
    }
}

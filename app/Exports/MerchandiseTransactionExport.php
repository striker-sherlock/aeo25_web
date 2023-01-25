<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\MerchandiseTransaction;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MerchandiseTransactionExport implements FromCollection, WithHeadings,ShouldAutoSize
{
    public function collection()
    {
        $data = DB::table('merchandise_transactions')->where('is_confirmed', 1)
        ->join('payment_providers','merchandise_transactions.payment_provider_id','payment_providers.id')
        ->select(
            'merchandise_transactions.id as id',
            'merchandise_transactions.name',
            'merchandise_transactions.email',
            'merchandise_transactions.phone_number',
            'merchandise_transactions.account_number',
            'merchandise_transactions.amount',
            'merchandise_transactions.tracking_link',
            'merchandise_transactions.payment_email',
            'payment_providers.type as Payment Type',
            'payment_providers.name  as Payment Name',
        )->get();

        return $data;
    }

    public function headings():array{
        return ["ID", "Customer Name", "Customer Email", "Contact","Account Number", "Grand Total","Tracking Link","Payment Email", "Payment Type","Payment Name"];
    }

}

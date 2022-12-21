<?php

namespace App\Exports;

use App\Models\MerchandiseTransaction;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;

class MerchandiseTransactionExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $data = DB::table('merchandise_transactions')->where('is_confirmed', 1)
        ->select(
            'merchandise_transactions.id as id',
            'merchandise_transactions.name',
            'merchandise_transactions.email',
            'merchandise_transactions.phone_number',
            'merchandise_transactions.account_number',
            'merchandise_transactions.amount',
        )->get();
        return $data;
    }

    public function headings():array{
        return ["ID", "Customer Name", "Customer Email", "Contact","Account Number", "Grand Total"];
    }

}

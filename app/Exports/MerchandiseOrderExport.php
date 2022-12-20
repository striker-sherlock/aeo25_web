<?php

namespace App\Exports;

use App\Models\MerchandiseOrder;
use App\Models\Merchandise;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;

class MerchandiseOrderExport implements FromCollection, WithHeadings
{
    
    public function collection()
    {
        $data = DB::table('merchandise_orders')
        ->join('merchandises', 'merchandise_orders.merchandise_id', '=', 'merchandises.id')
        ->join('merchandise_transactions', 'merchandise_orders.transaction_id', '=', 'merchandise_transactions.id')
        ->select(
            'merchandise_orders.id',
            'merchandises.name as item',
            'merchandise_transactions.name as Customer',
            'merchandise_orders.quantity',
            'merchandise_orders.order_details',
        )->get();
        foreach($data as $customer){
            if($customer->order_details == NULL){
                $customer->order_details = "No Notes";
            }
        }
        return $data;
    }
    public function headings():array{
        return ["ID", "Merch Name", "Customer", "Quantity", "Order Details"];
    }
}

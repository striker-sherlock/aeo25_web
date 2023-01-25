<?php

namespace App\Exports;

use App\Models\Merchandise;
use App\Models\MerchandiseOrder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MerchandiseOrderExport implements FromCollection, WithHeadings,ShouldAutoSize
{
    
    public function collection()
    {
        $data = DB::table('merchandise_orders')
        ->join('merchandises', 'merchandise_orders.merchandise_id', '=', 'merchandises.id')
        ->join('merchandise_transactions', 'merchandise_orders.transaction_id', '=', 'merchandise_transactions.id')
        ->orderBy('merchandises.name')
        ->select(
            'merchandise_orders.id',
            'merchandises.name as item',
            'merchandise_transactions.name as Customer',
            'merchandise_orders.quantity',
            'merchandise_orders.order_details',
            'merchandise_transactions.address'
        )->get();
        foreach($data as $customer){
            if($customer->order_details == NULL){
                $customer->order_details = "No Notes";
            }
        }

        foreach($data as $address){
            if($address->address == NULL){
                $address->address = "Ambil di binus";
            }
        }
        return $data;
    }
    public function headings():array{
        return ["ID", "Merch Name", "Customer", "Quantity", "Order Details", "Address"];
    }
}

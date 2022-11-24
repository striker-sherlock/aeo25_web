<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_providers')->insert([
            [
                'type' => 'BANK',
                'name' => 'BNI',
                'created_by' => 'admin',
            ],
            [
                'type' => 'BANK',
                'name' => 'BRI',
                'created_by' => 'admin',
            ],
            [
                'type' => 'BANK',
                'name' => 'Mandiri',
                'created_by' => 'admin',
            ],
            [
                'type' => 'BANK',
                'name' => 'BCA',
                'created_by' => 'admin',
            ],
            [
                'type' => 'BANK',
                'name' => 'CIMB Niaga',
                'created_by' => 'admin',
            ],
            [
                'type' => 'BANK',
                'name' => 'Permata',
                'created_by' => 'admin',
            ],
            [
                'type' => 'BANK',
                'name' => 'Danamon',
                'created_by' => 'admin',
            ],
            [
                'type' => 'BANK',
                'name' => 'Mega',
                'created_by' => 'admin',
            ],
            [
                'type' => 'BANK',
                'name' => 'Commonwealth',
                'created_by' => 'admin',
            ],
            [
                'type' => 'BANK',
                'name' => 'OCBC NISP',
                'created_by' => 'admin',
            ],
            [
                'type' => 'BANK',
                'name' => 'Bukopin',
                'created_by' => 'admin',
            ],

            [
                'type' => 'BANK',
                'name' => 'BTPN',
                'created_by' => 'admin',
            ],

            [
                'type' => 'BANK',
                'name' => 'Other',
                'created_by' => 'admin',
            ],
            [
                'type' => 'E WAL',
                'name' => 'OVO',
                'created_by' => 'admin',
            ],
            [
                'type' => 'E WAL',
                'name' => 'GOPAY',
                'created_by' => 'admin',
            ],
            [
                'type' => 'E WAL',
                'name' => 'Dana',
                'created_by' => 'admin',
            ],
            [
                'type' => 'E WAL',
                'name' => 'Other',
                'created_by' => 'admin',
            ],
            [
                'type' => 'Wise',
                'name' => null,
                'created_by' => 'admin',
            ],
            [
                'type' => 'Western Union',
                'name' => null ,
                'created_by' => 'admin',
            ],
        ]);
    }
}

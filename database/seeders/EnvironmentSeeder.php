<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EnvironmentSeeder extends Seeder
{
    public function run()
    {
        DB::table('environments')->insert([
            [
                'env_code' => 'ENV001',
                'env_name' => 'Flight Tickets',
            ],
            [
                'env_code' => 'ENV002',
                'env_name' => 'Flight Registrations',
            ],
            [
                'env_code' => 'ENV003',
                'env_name' => 'Frequently Asked Questions',
            ],
            [
                'env_code' => 'ENV004',
                'env_name' => 'Home Page',
            ],
            [
                'env_code' => 'ENV005',
                'env_name' => 'User Accommodation Payment',
            ],
            [
                'env_code' => 'ENV006',
                'env_name' => 'User Accommodation Guest',
            ],
            [
                'env_code' => 'ENV007',
                'env_name' => 'User Competition Payment',
            ],
            [
                'env_code' => 'ENV008',
                'env_name' => 'User Competition Participant',
            ],
            [
                'env_code' => 'ENV009',
                'env_name' => 'Competition Slot Registration',
            ],
            [
                'env_code' => 'ENV010',
                'env_name' => 'Accommodation Slot Registration',
            ],
            
        ]);
    }
}

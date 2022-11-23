<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            [
                'name' => "Bangladesh",
                'created_by' => 'admin',
            ],
            [
                'name' => "Bahrain",
                'created_by' => 'admin',
            ],
            [
                'created_by' => 'admin',
                'name' => "Afghanistan",
                'created_by' => 'admin',
            ],
            [
                'name' => "Bhutan",
                'created_by' => 'admin',
            ],

            [
                'name' => "Brunei Darussalam",
                'created_by' => 'admin',
            ],
            [
                'name' => "Cambodia",
                'created_by' => 'admin',
            ],
            [
                'name' => "China",
                'created_by' => 'admin',
            ],
            [
                'name' => "India",
                'created_by' => 'admin',
            ],
            [
                'name' => "Indonesia",
                'created_by' => 'admin',
            ],
            [
                'name' => "Iran",
                'created_by' => 'admin',
            ],
            [
                'name' => "Iraq",
                'created_by' => 'admin',
            ],
            [
                'name' => "Hongkong, China",
                'created_by' => 'admin',
            ],
            [
                'name' => "Japan",
                'created_by' => 'admin',
            ],
            [
                'name' => "Jordan",
                'created_by' => 'admin',
            ],
            [
                'name' => "Kazakhstan",
                'created_by' => 'admin',
            ],
            [
                'name' => "Kuwait",
                'created_by' => 'admin',
            ],
            [
                'name' => "Kyrgyzstan",
                'created_by' => 'admin',
            ],
            [
                'name' => "Laos",
                'created_by' => 'admin',
            ],
            [
                'name' => "Lebanon",
                'created_by' => 'admin',
            ],
            [
                'name' => "Iraq",
                'created_by' => 'admin',
            ],
            [
                'name' => "Macau, China",
                'created_by' => 'admin',
            ],
            [
                'name' => "Malaysia",
                'created_by' => 'admin',
            ],
            [
                'name' => "Maldives",
                'created_by' => 'admin',
            ],
            [
                'name' => "Mongolia",
                'created_by' => 'admin',
            ],
            [
                'name' => "Myanmar",
                'created_by' => 'admin',
            ],
            [
                'name' => "Nepal",
                'created_by' => 'admin',
            ],
            [
                'name' => "North Korea",
                'created_by' => 'admin',
            ],
            [
                'name' => "Oman",
                'created_by' => 'admin',
            ],
            [
                'name' => "Pakistan",
                'created_by' => 'admin',
            ],
            [
                'name' => "Palestine",
                'created_by' => 'admin',
            ],
            [
                'name' => "Nepal",
                'created_by' => 'admin',
            ],
            [
                'name' => "North Korea",
                'created_by' => 'admin',
            ],
            [
                'name' => "Oman",
                'created_by' => 'admin',
            ],
            [
                'name' => "Pakistan",
                'created_by' => 'admin',
            ],
            [
                'name' => "Palestine",
                'created_by' => 'admin',
            ],
            [
                'name' => "Philippines",
                'created_by' => 'admin',
            ],
            [
                'name' => "Qatar",
                'created_by' => 'admin',
            ],
            [
                'name' => "Saudi Arabia",
                'created_by' => 'admin',
            ],
            [
                'name' => "Singapore",
                'created_by' => 'admin',
            ],
            [
                'name' => "South Korea",
                'created_by' => 'admin',
            ],
            [
                'name' => "Sri Lanka",
                'created_by' => 'admin',
            ],
            [
                'name' => "Syria",
                'created_by' => 'admin',
            ],
            [
                'name' => "Taiwan",
                'created_by' => 'admin',
            ],
            [
                'name' => "Tajikistan",
                'created_by' => 'admin',
            ],
            [
                'name' => "Thailand",
                'created_by' => 'admin',
            ],
            [
                'name' => "Timor-Leste",
                'created_by' => 'admin',
            ],
            [
                'name' => "Turkmenistan",
                'created_by' => 'admin',
            ],
            [
                'name' => "United Arab Emirates (UAE)",
                'created_by' => 'admin',
            ],
            [
                'name' => "Uzbekistan",
                'created_by' => 'admin',
            ],
            [
                'name' => "Vietnam",
                'created_by' => 'admin',
            ],
            [
                'name' => "Yemen",
                'created_by' => 'admin',
            ],


        ]);
    }
}

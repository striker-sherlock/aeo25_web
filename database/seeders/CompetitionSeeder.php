<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('competitions')->insert([
            [
                'created_by' => 'Admin-IT',
                'id' => 'DB',
                'name' => 'Debate',
                'fixed_quota' => 10,
                'temp_quota' => 10,
                'price' => 200000,
                'content' => 'Content DB',
                'logo' => 'logoDB.png',
                'need_submission' => 0,
                'need_team' => 1,
                'max_people' => 2
            ],
            [
                'created_by' => 'Admin-IT',
                'id' => 'IA',
                'name' => 'Independent Adjudicator',
                'fixed_quota' => 10,
                'temp_quota' => 10,
                'price' => 150000,
                'content' => 'Content IA',
                'logo' => 'logoIA.png',
                'need_submission' => 0,
                'need_team' => 0,
                'max_people' => 1
            ],
            [
                'created_by' => 'Admin-IT',
                'id' => 'SP',
                'name' => 'Speech',
                'fixed_quota' => 10,
                'temp_quota' => 10,
                'price' => 250000,
                'content' => 'Content SP',
                'logo' => 'logoSP.png',
                'need_submission' => 0,
                'need_team' => 0,
                'max_people' => 1
            ],
            [
                'created_by' => 'Admin-IT',
                'id' => 'RD',
                'name' => 'Radio Drama',
                'fixed_quota' => 10,
                'temp_quota' => 10,
                'price' => 250000,
                'content' => 'Content RD',
                'logo' => 'logoRD.png',
                'need_submission' => 1,
                'need_team' => 1,
                'max_people' => 5
            ],
            [
                'created_by' => 'Admin-IT',
                'id' => 'OBS',
                'name' => 'Observer',
                'fixed_quota' => 10,
                'temp_quota' => 10,
                'price' => 350000,
                'content' => NULL,
                'logo' => NULL,
                'need_submission' => 0,
                'need_team' => 0,
                'max_people' => 1
            ],
        ]);
    }
}

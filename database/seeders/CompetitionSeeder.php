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
                'fixed_quota' => 100,
                'temp_quota' => 100,
                'price' => 850000,
                'content' => 'Content DB',
                'logo' => 'logoDB.webp',
                'need_submission' => 0,
                'need_team' => 1,
                'max_people' => 2
            ],
            [
                'created_by' => 'Admin-IT',
                'id' => 'NC',
                'name' => 'News Casting',
                'fixed_quota' => 70,
                'temp_quota' => 70,
                'price' => 650000,
                'content' => 'Content DB',
                'logo' => 'logoNC.webp',
                'need_submission' => 0,
                'need_team' => 0,
                'max_people' => 2
            ],
            [
                'created_by' => 'Admin-IT',
                'id' => 'SB',
                'name' => 'Spelling Bee',
                'fixed_quota' => 60,
                'temp_quota' => 60,
                'price' => 650000,
                'content' => 'Content DB',
                'logo' => 'logoSB.webp',
                'need_submission' => 0,
                'need_team' => 0,
                'max_people' => 2
            ],
            [
                'created_by' => 'Admin-IT',
                'id' => 'IA',
                'name' => 'Independent Adjudicator',
                'fixed_quota' => 10,
                'temp_quota' => 10,
                'price' => 400000,
                'content' => 'Content IA',
                'logo' => 'logoIA.webp',
                'need_submission' => 0,
                'need_team' => 0,
                'max_people' => 1
            ],
            [
                'created_by' => 'Admin-IT',
                'id' => 'SP',
                'name' => 'Speech',
                'fixed_quota' => 70,
                'temp_quota' => 70,
                'price' => 650000,
                'content' => 'Content SP',
                'logo' => 'logoSP.webp',
                'need_submission' => 0,
                'need_team' => 0,
                'max_people' => 1
            ],
            [
                'created_by' => 'Admin-IT',
                'id' => 'ST',
                'name' => 'Story Telling',
                'fixed_quota' => 70,
                'temp_quota' => 70,
                'price' => 650000,
                'content' => 'Content SP',
                'logo' => 'logoST.webp',
                'need_submission' => 0,
                'need_team' => 0,
                'max_people' => 1
            ],
            [
                'created_by' => 'Admin-IT',
                'id' => 'RD',
                'name' => 'Radio Drama',
                'fixed_quota' => 25,
                'temp_quota' => 25,
                'price' => 450000,
                'content' => 'Content RD',
                'logo' => 'logoRD.webp',
                'need_submission' => 1,
                'need_team' => 1,
                'max_people' => 5
            ],
            [
                'created_by' => 'Admin-IT',
                'id' => 'OBS',
                'name' => 'Spectator',
                'fixed_quota' => 10,
                'temp_quota' => 10,
                'price' => 450000,
                'content' => NULL,
                'logo' => 'logoOBS.webp',
                'need_submission' => 0,
                'need_team' => 0,
                'max_people' => 1
            ],
            [
                'created_by' => 'Admin-IT',
                'id' => 'SSW',
                'name' => 'Short Story Writing',
                'fixed_quota' => 80,
                'temp_quota' => 80,
                'price' => 450000,
                'content' => 'content SSW',
                'logo' => 'logoSSW.webp',
                'need_submission' => 0,
                'need_team' => 0,
                'max_people' => 1
            ],
        ]);
    }
}

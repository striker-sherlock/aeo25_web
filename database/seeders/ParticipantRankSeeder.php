<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParticipantRankSeeder extends Seeder
{
    public function run()
    {
        DB::table('participant_ranks')->insert([
            [
                'created_by' => "Admin",
                'id' => 0,
                'rank_name' => 'Not Ranked'
            ],
            [
                'created_by' => "Admin",
                'id' => 1,
                'rank_name' => 'Preliminary'
            ],
            [
                'created_by' => "Admin",
                'id' => 2,
                'rank_name' => 'Octo Finalist'
            ],
            [
                'created_by' => "Admin",
                'id' => 3,
                'rank_name' => 'Quarter Finalist'
            ],
            [
                'created_by' => "Admin",
                'id' => 4,
                'rank_name' => 'Semi Finalist'
            ],
            [
                'created_by' => "Admin",
                'id' => 5,
                'rank_name' => 'Finalist'
            ],
            [
                'created_by' => "Admin",
                'id' => 6,
                'rank_name' => 'First Runner Up'
            ],
            [
                'created_by' => "Admin",
                'id' => 7,
                'rank_name' => 'Second Runner Up'
            ],
            [
                'created_by' => "Admin",
                'id' => 8,
                'rank_name' => 'Champion'
            ],
    ]);
    }
}

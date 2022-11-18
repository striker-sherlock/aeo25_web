<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accesses')->insert([
            [
                'id' => 1,
                'name' => 'Competition Payments',
                'created_by' => 'admin',
            ],
            [
                'id' => 2,
                'name' => 'Competition Slots',
                'created_by' => 'admin',
            ],
            [
                'id' => 3,
                'name' => 'Follow Up List',
                'created_by' => 'admin',
            ],
            [
                'id' => 4,
                'name' => 'Question List',
                'created_by' => 'admin',
            ],
            [
                'id' => 5,
                'name' => 'Competition Configuration',
                'created_by' => 'admin',
            ],
            [
                'id' => 6,
                'name' => 'Competition Participants',
                'created_by' => 'admin',
            ],
            [
                'id' => 7,
                'name' => 'Competition Submissions',
                'created_by' => 'admin',
            ],
            [
                'id' => 8,
                'name' => 'Competition Score',
                'created_by' => 'admin',
            ],
            [
                'id' => 9,
                'name' => 'Side Achievements',
                'created_by' => 'admin',
            ],
            [
                'id' => 10,
                'name' => 'Payment Providers',
                'created_by' => 'admin',
            ],
            [
                'id' => 11,
                'name' => 'Manage Ambassador',
                'created_by' => 'admin',
            ],
            [
                'id' => 12,
                'name' => 'Sponsorship',
                'created_by' => 'admin',
            ],
            [
                'id' => 13,
                'name' => 'Webinar Content',
                'created_by' => 'admin',
            ],
            [
                'id' => 14,
                'name' => 'Webinar Data',
                'created_by' => 'admin',
            ],
            [
                'id' => 15,
                'name' => 'Webinar Payments',
                'created_by' => 'admin',
            ],
            [
                'id' => 16,
                'name' => 'Main Event Schedule',
                'created_by' => 'admin',
            ],
            [
                'id' => 17,
                'name' => 'Media Partners',
                'created_by' => 'admin',
            ],
            [
                'id' => 18,
                'name' => 'Access Controls',
                'created_by' => 'admin',
            ],
            [
                'id' => 19,
                'name' => 'Environments',
                'created_by' => 'admin',
            ],
            [
                'id' => 20,
                'name' => 'Countries',
                'created_by' => 'admin',
            ],
            [
                'id' => 21,
                'name' => 'Home Content',
                'created_by' => 'admin',
            ],
            [
                'id' => 22,
                'name' => 'FAQ',
                'created_by' => 'admin',
            ],
            [
                'id' => 23,
                'name' => 'Webinar Controller',
                'created_by' => 'admin',
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'created_by' => "asd",
            'pic_name' => 'pic',
            'username' => 'pic',
            'email' => 'gerenwidiarta477@gmail.com',
            'pic_phone_number' => 123123123,
            'country_id' => 1,
            'institution_name' => 'BINA NUSANTARA',
            'institution_email' => 'MIT & Regist',
            'institution_type' => 'University',
            'institution_logo' => 'Media Information Technology',
            'password' => Hash::make("pic123")
        ]);
    }
}

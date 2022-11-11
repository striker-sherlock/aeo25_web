<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'created_by' => "asd",
            'name' => 'Admin',
            'nim' => 2541245123,
            'email' => 'admin123@gmail.com',
            'position' => 'coor',
            'position_id' => '1',
            'department' => 'MIT & Regist',
            'department_id' => '1',
            'division' => 'Media Information Technology',
            'division_id' => 'MIT',
            'password' => Hash::make("admin1234")
        ]);
    }
}

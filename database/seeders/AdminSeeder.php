<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        DB::table('admins')->insert(
            [
                [
                    'created_by' => 'admin',
                    'name' =>  'Edison Valentino',
                    'nim' =>  '2440071123',
                    'email' => 'edison@gmail.com',
                    'position_id' => 1,
                    'position' => 'staff',
                    'department_id' => 'MITR',
                    'department' => 'MIT Registration',
                    'division_id' => 'NR',
                    'division' => 'National Registration',
                    'password' => Hash::make("test123&*^")
                ],

                [
                    'created_by' => 'admin',
                    'name' =>  'Geren Widiarta',
                    'nim' =>  '2515051173',
                    'email' => 'gerenn@gmail.com',
                    'position_id' => 2,
                    'position' => 'coordinator',
                    'department_id' => 'MITR',
                    'department' => 'MIT Registration',
                    'division_id' => 'MIT',
                    'division' => 'Media Information Technology',
                    'password' => Hash::make("test123&*^")
                ],

                [
                    'created_by' => 'admin',
                    'name' =>  'Stefan Bondito',
                    'nim' =>  '2515051173',
                    'email' => 'stefan@gmail.com',
                    'position_id' => 2,
                    'position' => 'Staff',
                    'department_id' => 'MITR',
                    'department' => 'MIT Registration',
                    'division_id' => 'MIT',
                    'division' => 'Media Information Technology',
                    'password' => Hash::make("admin123")
                ],

                [
                    'created_by' => 'admin',
                    'name' =>  'Jose Stephen',
                    'nim' =>  '2540871623',
                    'email' => 'yose@gmail.com',
                    'position_id' => 3,
                    'position' => 'director',
                    'department_id' => 'MITR',
                    'department' => 'MIT Registration',
                    'division_id' => 'DRC',
                    'division' => 'Director',
                    'password' => Hash::make("test123&*^")
                ],

                [
                    'created_by' => 'admin',
                    'name' =>  'Nicholas Frederick Oongwidjaja',
                    'nim' =>  '2515783793',
                    'email' => 'nico@gmail.com',
                    'position_id' => 4,
                    'position' => 'Vice President of Marketing',
                    'department_id' => 'SC',
                    'department' => 'Steering Committee',
                    'division_id' => 'SC',
                    'division' => 'Steering Committee',
                    'password' => Hash::make("test123&*^")
                ],

                [
                    'created_by' => 'admin',
                    'name' =>  'Masika Hermawan',
                    'nim' =>  '2615783793',
                    'email' => 'masika@gmail.com',
                    'position_id' => 1,
                    'position' => 'Staff',
                    'department_id' => 'MITR',
                    'department' => 'MIT Registration',
                    'division_id' => 'NR',
                    'division' => 'National Registration',
                    'password' => Hash::make("test123&*^")
                ],

                [
                    'created_by' => 'admin',
                    'name' =>  'Gabriella Saputra Suntara',
                    'nim' =>  '2515723693',
                    'email' => 'gaby@gmail.com',
                    'position_id' => 1,
                    'position' => 'Staff',
                    'department_id' => 'MITR',
                    'department' => 'MIT Registration',
                    'division_id' => 'NR',
                    'division' => 'National Registration',
                    'password' => Hash::make("test123&*^")
                ],

                [
                    'created_by' => 'admin',
                    'name' =>  'Thaddeus Kendrick Andrian',
                    'nim' =>  '2615224653',
                    'email' => 'thaddeus@gmail.com',
                    'position_id' => 1,
                    'position' => 'Staff',
                    'department_id' => 'MITR',
                    'department' => 'MIT Registration',
                    'division_id' => 'NR',
                    'division' => 'National Registration',
                    'password' => Hash::make("test123&*^"),
                ],

                [
                    'created_by' => 'admin',
                    'name' =>  'Andru Hafiz Permana',
                    'nim' =>  '2614526613',
                    'email' => 'andru@gmail.com',
                    'position_id' => 1,
                    'position' => 'Staff',
                    'department_id' => 'MITR',
                    'department' => 'MIT Registration',
                    'division_id' => 'IR',
                    'division' => 'International Registration',
                    'password' => Hash::make("test123&*^"),
                ],

                [
                    'created_by' => 'admin',
                    'name' =>  'Muhammad Keinanthan',
                    'nim' =>  '2600521645',
                    'email' => 'kein@gmail.com',
                    'position_id' => 1,
                    'position' => 'Staff',
                    'department_id' => 'MITR',
                    'department' => 'MIT Registration',
                    'division_id' => 'IR',
                    'division' => 'International Registration',
                    'password' => Hash::make("test123&*^"),
                ],
                
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
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
        // User::factory(200)->create();
        DB::table('users')->insert(
            [
                'created_by' => 'pic',
                'pic_name' => 'pic',
                'username' => 'pic',
                'email' => 'gerenwidiarta477@gmail.com',
                'pic_phone_number' => '12323',
                'country_id' => 12,
                'institution_name' => 'Bina Nusantara',
                'institution_email' => 'asdf@gmail.com',
                'institution_type' =>'school',
                'institution_logo' => 'asdf',
                'password' =>Hash::make('pic123'), // password
                'remember_token' => Str::random(10),

            ]);
                
    }
}

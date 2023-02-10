<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\User_details;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->user_id = 'A22U000001';
        $user->type = 'admin';
        $user->first_name = 'mz';
        $user->last_name = 'shanto';
        $user->phone = '01710101010';
        $user->email = 'admin@admin.com';
        $user->password = Hash::make(123456);
        $user->save();

        $user = new User_details;
        $user->user_id = 1;
        $user->gender = 'Male';
        $user->division = 'Dhaka';
        $user->district = 'Dhaka';
        $user->thana_upazila = 'Uttara';
        $user->address = 'Azampur';
        $user->save();

    }
}

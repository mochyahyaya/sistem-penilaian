<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com', 
            'password' => Hash::make('admin'),
            'school' => null, 
            'phone_number' => 12345678910,
            'role_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        User::create([
            'name' => 'Agus',
            'email' => 'agus@student.com', 
            'password' => Hash::make('student'),
            'school' => 'SMA 2 Brebes', 
            'phone_number' => 23456789122,
            'role_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        User::create([
            'name' => 'Gifa',
            'email' => 'gifa@student.com', 
            'password' => Hash::make('student'),
            'school' => 'SMA 3 Ciamis', 
            'phone_number' => 7854612231,
            'role_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}

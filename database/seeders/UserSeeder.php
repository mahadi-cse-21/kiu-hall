<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       User::factory()->create(
        [
            'name'=>'manager',
            'email'=>'mahadi.cse.21@gmail.com',
            'role'=>'manager',
            'meal_floor'=>'3',
            'status'=>'active',
            'contact'=>'01780689788',
            'password'=>Hash::make('12341234'),
        ]
       );
    //    User::factory()->create(
    //     [
    //         'name'=>'manager',
    //         'email'=>'admin@gmail.com',
    //         'role'=>'manager',
    //         'status'=>'active',
    //         'password'=>Hash::make('1234'),
    //     ]
    //    );
    }
}

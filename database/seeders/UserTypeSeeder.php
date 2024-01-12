<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Mário World',
            'email' => 'mario@world.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
        ])->assignRole('Admin','User');

        User::create([
            'name' => 'Luigi World',
            'email' => 'luigi@world.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
        ])->assignRole('User');
    }
}

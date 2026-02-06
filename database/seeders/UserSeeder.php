<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Mario',
            'email' => 'mario@world.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ])->assignRole('Admin','User');

        User::create([
            'name' => 'Luigi',
            'email' => 'luigi@world.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ])->assignRole('User');

        User::create([
            'name' => 'Bowser',
            'email' => 'bowser@world.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ])->assignRole('User');
    }
}

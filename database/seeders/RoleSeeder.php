<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\{Role,Permission};
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'User']);

        Permission::create(['name' => 'Estudar Inglês']);
        Permission::create(['name' => 'Estudar Espanhol']);
        Permission::create(['name' => 'Estudar Vue 3']);
        Permission::create(['name' => 'Estudar Cybersecurity']);
        Permission::create(['name' => 'Estudar MongoDB']);
    }
}

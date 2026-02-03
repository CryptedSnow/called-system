<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\{Role, Permission};
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'Estudar Inglês',
            'Estudar Espanhol',
            'Estudar Vue 3',
            'Estudar Cybersecurity',
            'Estudar MongoDB',
        ];

        foreach ($permissions as $p) {
            Permission::firstOrCreate(
                ['name' => $p],
                ['guard_name' => 'web']
            );
        }

        $adminRole = Role::firstOrCreate(
            ['name' => 'Admin'],
            ['guard_name' => 'web']
        );

        $userRole = Role::firstOrCreate(
            ['name' => 'User'],
            ['guard_name' => 'web']
        );

        $adminPermissions = Permission::whereIn('name', [
            'Estudar Inglês',
            'Estudar Espanhol',
            'Estudar Vue 3',
        ])->get();

        $userPermissions = Permission::whereIn('name', [
            'Estudar Cybersecurity',
            'Estudar MongoDB',
        ])->get();

        $adminRole->syncPermissions($adminPermissions);
        $userRole->syncPermissions($userPermissions);
    }
}

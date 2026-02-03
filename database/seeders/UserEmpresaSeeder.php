<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserEmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_empresas = [
            [
                'user_id' => 1,
                'empresa_id' => 1,
            ],
            [
                'user_id' => 1,
                'empresa_id' => 2,
            ],
            [
                'user_id' => 2,
                'empresa_id' => 2,
            ]
        ];

        DB::table('users_empresas')->insert($user_empresas);
    }
}

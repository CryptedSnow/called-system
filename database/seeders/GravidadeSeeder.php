<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GravidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gravidades = [
            ['tipo_gravidade' => 'Baixa'],
            ['tipo_gravidade' => 'Média'],
            ['tipo_gravidade' => 'Alta'],
            ['tipo_gravidade' => 'Crítica'],
            ['tipo_gravidade' => 'Emergencial'],
        ];

        DB::table('gravidades')->insert($gravidades);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empresas = [
            ['nome_fantasia' => 'Nostradamus', 'cnpj_empresa' => '92.772.051/0001-50'],
            ['nome_fantasia' => 'King Arthur', 'cnpj_empresa' => '56.891.048/0001-91'],
        ];

        DB::table('empresas')->insert($empresas);
    }
}

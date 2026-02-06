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
            ['nome_fantasia' => 'Yoshi\'s island', 'cnpj_empresa' => '92.772.051/0001-50'],
            ['nome_fantasia' => 'Ghost House', 'cnpj_empresa' => '56.891.048/0001-91'],
            ['nome_fantasia' => 'Valley of Bowser', 'cnpj_empresa' => '89.747.541/0001-91'],
        ];

        DB::table('empresas')->insert($empresas);
    }
}

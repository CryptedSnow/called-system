<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = [
            ['tipo_status' => 'Andamento'],
            ['tipo_status' => 'Concluído'],
        ];

        DB::table('status')->insert($status);
    }
}

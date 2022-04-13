<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EscrutinioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $escrutinios = ['1º Escrutínio', '2º Escrutínio', '3º Escrutínio'];
        foreach ($escrutinios as $escrutinio) {
            DB::table('escrutinios')->insert([
                'escrutinio' => $escrutinio
            ]);
        }
    }
}

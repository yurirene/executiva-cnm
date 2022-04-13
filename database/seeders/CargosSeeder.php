<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cargos = [
            'Presidente',
            'Vice-Presidente Norte',
            'Vice-Presidente Nordeste',
            'Vice-Presidente Centro-Oeste',
            'Vice-Presidente Sudeste',
            'Vice-Presidente Sul',
            'Secretário-Executivo',
            '1º Secretário',
            '2º Secretário',
            'Tesoureiro'
        ];
        foreach ($cargos as $cargo) {
            DB::table('cargos')->insert([
                'cargo' => $cargo
            ]);
        }
    }
}

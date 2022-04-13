<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegioesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cargos = [
            'Norte',
            'Nordeste',
            'Centro-Oeste',
            'Sudeste',
            'Sul'
        ];
        foreach ($cargos as $cargo) {
            DB::table('regioes')->insert([
                'nome' => $cargo
            ]);
        }
    }
}

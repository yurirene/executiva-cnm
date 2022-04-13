<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CargosSeeder::class);
        $this->call(EscrutinioSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RegioesSeeder::class);
        $this->call(SistemaSeeder::class);
    }
}

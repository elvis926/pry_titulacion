<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ComentariosTableSeeder::class);
        $this->call(PostulacionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SolicitudsTableSeeder::class);

      
    }
}

<?php

namespace Database\Seeders;

use App\Models\Comentario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ComentariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Vaciar la tabla comentarios
        Comentario::truncate();
        $faker = \Faker\Factory::create();

        //crear comentarios
        for($i = 0; $i < 20 ; $i++) {
            Comentario::create([
                'text' => $faker->paragraph,
            ]);
            }

         
    }
}

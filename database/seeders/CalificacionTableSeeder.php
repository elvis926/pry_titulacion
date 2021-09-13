<?php

namespace Database\Seeders;

use App\Models\Calificacion;
use Illuminate\Database\Seeder;

class CalificacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Vaciar la tabla calificaciones
        Calificacion::truncate();
        $faker = \Faker\Factory::create();

        //crear calificacion
        $calificacion=['1','2','3','4','5'];
        for($i = 0; $i < 10 ; $i++) {
            Calificacion::create([
                'calificacion'=> $faker->randomElement($calificacion),
            ]);
            }
    }
}

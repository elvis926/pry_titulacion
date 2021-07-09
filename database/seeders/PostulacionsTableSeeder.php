<?php

namespace Database\Seeders;

use App\Models\Postulacion;
use Illuminate\Database\Seeder;

class PostulacionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Vaciar la tabla Postulacione
        Postulacion::truncate();
        $faker = \Faker\Factory::create();

        //crear postulacion
        $estado=['Espera','Asignado','Terminado'];
        for ($i = 0; $i < 30; $i++) {
            $postulacion=Postulacion::create([
                'estado'=> $faker->randomElement($estado),
            ]);
        }
    }
}

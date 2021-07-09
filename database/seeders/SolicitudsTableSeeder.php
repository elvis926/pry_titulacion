<?php

namespace Database\Seeders;

use App\Models\Solicitud;
use Illuminate\Database\Seeder;

class SolicitudsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //Vaciar la tabla comentarios
         Solicitud::truncate();
         $faker = \Faker\Factory::create();

         //crear solicitudes
        $dano = ['Pantalla Azul','Lentiutud','No enciende','Pitidos'];
        for ($i = 0; $i < 30; $i++) {
            Solicitud::create([
                'descripcionPc' => $faker->paragraph,
                'fechaIni' => $faker->dateTime()->format('Y-m-d'),
                'fechaFin' => $faker->dateTime()->format('Y-m-d'),
                'dano'=> $faker->randomElement($dano),
                'descripcion' => $faker->paragraph,
            ]);
        }
    }
}

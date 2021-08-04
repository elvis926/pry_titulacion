<?php

namespace Database\Seeders;

use App\Models\Tecnico;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TecnicoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Vaciar la tabla tecnicos
        Tecnico::truncate();
        $faker = \Faker\Factory::create();

        $password = Hash::make('123123');

        //crear nuevos tecnicos
        for ($i = 0; $i < 20; $i++) {
            Tecnico::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'telefono' => $faker->phoneNumber,
                'password' => $password,
            ]);
       }
    }
}
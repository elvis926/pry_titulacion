<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla
        User::truncate();
        $faker = \Faker\Factory::create();
        // Crear la misma clave para todos los usuarios
        // conviene hacerlo antes del for para que el seeder
        // no se vuelva lento.
        $password = Hash::make('123123');
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@prueba.com',
            'password' => $password,
            //'rol_type' => 'Admin',
            'role'=> User::ROLE_ADMIN,
        ]);
        // Generar algunos usuarios
       // $rol=['teacher','student'];
        $role=['ROLE_ADMINTECNICO','ROLE_CLIENTE','ROLE_TECNICO'];
        for ($i = 0; $i < 30; $i++) {
            $user=User::create([
                'name' => $faker->firstName,
                'email' => $faker->email,
                'password' => $password,
                'role'=> $faker->randomElement($role),
            ]);
        }
    }
}

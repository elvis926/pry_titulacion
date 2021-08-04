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
        User::create([
            'name' => 'Administrador Tecnico',
            'email' => 'admint@prueba.com',
            'password' => $password,
            //'rol_type' => 'Admin',
            'role'=> User::ROLE_ADMINTECNICO,
        ]);
        // Generar algunos usuarios
       // $rol=['teacher','student'];
        $role=['ROLE_CLIENTE'];
        for ($i = 0; $i < 30; $i++) {
            $user=User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $password,
                'role'=> $faker->randomElement($role),
            ]);
        }
    }
}

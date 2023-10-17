<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Persona;
class SuperadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear el usuario correspondiente
        $user = User::create([
            'name' => 'Super Administrador',
            'email' => 'SuperAdmin@gmail.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
            'role' => 'Superadmin',
        ]);

        // Crear la persona y asociarla al usuario
        $persona = new Persona([
            'imagen' => '20231002185318.png',
            'nombres' => 'Elmer Dennis',
            'primer_apellido' => 'Velasquez',
            'segundo_apellido' => 'Pinto',
            'ci' => '8038256',
            'fecha_nacimiento' => '1987-07-28',
            'direccion' => 'cochabamba - bolivia',
            'celular' => '+59179968398',
            'sexo' => 'M',
        ]);

        // Asignar el usuario al campo 'user_id' en Persona
        $persona->user()->associate($user);
        $persona->save();

        // Crear el usuario correspondiente
        $user = User::create([
            'name' => 'Administrador',
            'email' => 'Admin@gmail.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
            'role' => 'admin',
        ]);

        // Crear la persona y asociarla al usuario
        $persona = new Persona([
            'imagen' => '20231002185318.png',
            'nombres' => 'Elmer Dennis',
            'primer_apellido' => 'Velasquez',
            'segundo_apellido' => 'Pinto',
            'ci' => '8038256',
            'fecha_nacimiento' => '1987-07-28',
            'direccion' => 'cochabamba - bolivia',
            'celular' => '+59179968398',
            'sexo' => 'M',
        ]);

        // Asignar el usuario al campo 'user_id' en Persona
        $persona->user()->associate($user);
        $persona->save();User::factory()

        ->count(10)
        ->state(['role' => 'admin'])
        ->create();

        // Crear el usuario correspondiente
        $user = User::create([
            'name' => 'Enfermero',
            'email' => 'Enfermero@gmail.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
            'role' => 'enfermera',
        ]);

        // Crear la persona y asociarla al usuario
        $persona = new Persona([
            'imagen' => '20231002185318.png',
            'nombres' => 'Elmer Dennis',
            'primer_apellido' => 'Velasquez',
            'segundo_apellido' => 'Pinto',
            'ci' => '8038256',
            'fecha_nacimiento' => '1987-07-28',
            'direccion' => 'cochabamba - bolivia',
            'celular' => '+59179968398',
            'sexo' => 'M',
        ]);

        // Asignar el usuario al campo 'user_id' en Persona
        $persona->user()->associate($user);
        $persona->save();

        User::factory()
            ->count(10)
            ->state(['role' => 'enfermera'])
            ->create();

        // Crear el usuario correspondiente
        $user = User::create([
            'name' => 'Paciente',
            'email' => 'Paciente@gmail.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
            'role' => 'paciente',
        ]);

        // Crear la persona y asociarla al usuario
        $persona = new Persona([
            'imagen' => '20231002185318.png',
            'nombres' => 'Elmer Dennis',
            'primer_apellido' => 'Velasquez',
            'segundo_apellido' => 'Pinto',
            'ci' => '8038256',
            'fecha_nacimiento' => '1987-07-28',
            'direccion' => 'cochabamba - bolivia',
            'celular' => '+59179968398',
            'sexo' => 'M',
        ]);

        // Asignar el usuario al campo 'user_id' en Persona
        $persona->user()->associate($user);
        $persona->save();

        User::factory()
            ->count(10)
            ->state(['role' => 'paciente'])
            ->create();
    }
}


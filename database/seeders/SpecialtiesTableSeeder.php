<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Especialidad;

use Illuminate\Database\Seeder;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = [
                'Médica',
                'Pediátrica',
                'Quirúrgica',
                'Salud Mental',
                'Cuidados Intensivos',
                'Obstetricia y Ginecología',
                'Geriátrica',
                'Cuidados Domiciliarios',
                'Anestesia',
                'Diálisis',
                'Urgencias',
                'Salud Comunitaria',
                'Cardiología'
        ];

}
}

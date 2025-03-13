<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;

class DoctorSeeder extends Seeder{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //Crear datos del doctor
        Doctor::create([
            'nombre' => 'Mario',
            'apellido' => 'Ruiz',
            'genero' => 'masculino',
            'turno' => 'mañana',
            'usuario_id' => 1,
        ]);
    }
}

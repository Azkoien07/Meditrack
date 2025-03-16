<?php

namespace Database\Seeders;

use App\Models\Paciente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Paciente::create([
            'nombre' => 'Erick',
            'apellido' => 'Koerting',
            'edad' => '72',
            'genero' => 'masculino',
            'telefono' => '3145678932',
            'tipo_identificacion' => 'CC',
            'identificacion' => '17932678',
            'eps' => 'Compensar',
            'f_nacimiento' => '1951-05-15',
            'usuario_id' => 1,
        ]);
    }
}

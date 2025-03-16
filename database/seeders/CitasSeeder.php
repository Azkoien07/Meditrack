<?php

namespace Database\Seeders;

use App\Models\Citas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Citas::create([
            'fecha' => '2025-03-20', // Fecha de la cita
            'hora' => '10:00',       // Hora de la cita
            'sede' => 'Calle 26',     // Sede de la cita
            'estado' => 'Pendiente', // Estado de la cita
            'doctor_id' => 1,        // ID del doctor (debe existir en la tabla doctores)
            'paciente_id' => 1,      // ID del paciente (debe existir en la tabla pacientes)
        ]);
    }
}

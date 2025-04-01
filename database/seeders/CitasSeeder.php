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
            'fecha' => '2025-03-20',
            'hora' => '10:00',
            'sede' => 'Calle 26',
            'estado' => 'Pendiente',
            'doctor_id' => 1,
            'paciente_id' => 1,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EspecialidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    {
        $especialidades = [
            ['cod_especialidad' => 'ESP001', 'nombre' => 'Pediatría', 'descripcion' => 'Especialidad en el cuidado de niños'],
            ['cod_especialidad' => 'ESP002', 'nombre' => 'Cardiología', 'descripcion' => 'Especialidad en enfermedades del corazón'],
            ['cod_especialidad' => 'ESP003', 'nombre' => 'Dermatología', 'descripcion' => 'Cuidado de la piel'],
            ['cod_especialidad' => 'ESP004', 'nombre' => 'Neurología', 'descripcion' => 'Tratamiento de enfermedades del sistema nervioso'],
            ['cod_especialidad' => 'ESP005', 'nombre' => 'Oftalmología', 'descripcion' => 'Diagnóstico y tratamiento de enfermedades oculares'],
        ];

        foreach ($especialidades as $especialidad) {
            DB::table('especialidades')->insert([
                'cod_especialidad' => $especialidad['cod_especialidad'],
                'nombre' => $especialidad['nombre'],
                'descripcion' => $especialidad['descripcion'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
    }
}

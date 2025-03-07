<?php

namespace Database\Seeders;

use App\Models\Usuario;
use App\Models\Paciente;
use App\Models\Doctor;
use App\Models\Especialidad;
use App\Models\Rol;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear roles con ID predefinidos
        $roles = [
            ['id' => 1, 'nombre' => 'admin'],
            ['id' => 2, 'nombre' => 'Doctor'],
            ['id' => 3, 'nombre' => 'Paciente'],
        ];

        foreach ($roles as $rol) {
            Rol::updateOrCreate(['id' => $rol['id']], $rol);
        }

        // Crear usuarios
        $usuarios = [
            [
                'correo' => 'admin@example.com',
                'contrasena' => bcrypt('676576767'),
                'rol_id' => 1, // Administrador
            ],
            [
                'correo' => 'doctor1@example.com',
                'contrasena' => bcrypt('34343443'),
                'rol_id' => 2, // Doctor
            ],
            [
                'correo' => 'paciente1@example.com',
                'contrasena' => bcrypt('678877899'),
                'rol_id' => 3, // Paciente
            ],
        ];

        foreach ($usuarios as $usuario) {
            Usuario::create($usuario);
        }

        // Crear pacientes
        $pacientes = [
            [
                'nombre' => 'Juan',
                'apellido' => 'Pérez',
                'edad' => 30,
                'genero' => 'Masculino',
                'telefono' => '1234567890',
                'tipo_identificacion' => 'CC',
                'identificacion' => '123456789',
                'eps' => 'Sanitas',
                'f_nacimiento' => '1993-05-15',
                'usuario_id' => 3, // Asignar al tercer usuario (Paciente)
            ],
        ];

        foreach ($pacientes as $paciente) {
            Paciente::create($paciente);
        }

        // Crear doctores
        $doctores = [
            [
                'nombre' => 'Carlos',
                'apellido' => 'López',
                'telefono' => '5551234567',
                'email' => 'carlos@example.com',
                'usuario_id' => 2, // Asignar al segundo usuario (Doctor)
            ], 
        ];

        foreach ($doctores as $doctor) {
            Doctor::create($doctor);
        }

        // Crear especialidades
        $especialidades = [
            [
                'nombre' => 'Cardiología',
                'descripcion' => 'Especialidad en enfermedades del corazón',
            ],
            [
                'nombre' => 'Dermatología',
                'descripcion' => 'Especialidad en enfermedades de la piel',
            ],
        ];

        foreach ($especialidades as $especialidad) {
            Especialidad::create($especialidad);
        }

        // Asignar especialidades a los doctores (relación muchos a muchos)
        $doctor1 = Doctor::find(1);
        if ($doctor1) {
            $doctor1->especialidades()->attach([1, 2]);
        }

        $doctor2 = Doctor::find(2);
        if ($doctor2) {
            $doctor2->especialidades()->attach(1);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        // Crear un usuario doctor
        Usuario::create([
            'correo' => 'doctor@example.com',
            'contraseña' => Hash::make('doctor123'),
            'rol_id' => 3, // ID del rol doctor
        ]);

        Usuario::create([
            'correo' => 'doctor2@example.com',
            'contraseña' => Hash::make('doctor456'),
            'rol_id' => 3, // ID del rol doctor
        ]);
        // Crear un usuario paciente
        Usuario::create([
            'correo' => 'paciente@example.com',
            'contraseña' => Hash::make('paciente123'),
            'rol_id' => 2, // ID del rol paciente
        ]);
    }
}
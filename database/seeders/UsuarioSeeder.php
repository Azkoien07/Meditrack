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
    }
}
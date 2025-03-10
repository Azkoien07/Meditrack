<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolSeeder extends Seeder
{
    public function run()
    {
        $roles = ['admin', 'paciente', 'doctor'];

        foreach ($roles as $rol) {
            Rol::firstOrCreate(['nombre' => $rol]);
        }
    }
}

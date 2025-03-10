<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorEspecialidad extends Model{
    use HasFactory;

    // Relación muchos a muchos con Especialidad
    public function especialidades()
    {
        return $this->belongsToMany(Especialidad::class, 'doctor_especialidad', 'doctor_id', 'especialidad_id');
    }
}
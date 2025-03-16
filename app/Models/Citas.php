<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Citas extends Model
{
    protected $fillable = [
        'fecha',
        'hora',
        'sede',
        'estado',
        'doctor_id',
        'especialidad_id',
        'paciente_id',
    ];

    // Relación (N:1) con la tabla de Doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    // Relación (N:1) con la tabla de Especialidad
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }

    // Relación (N:1) con la tabla de Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}
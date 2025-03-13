<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Citas extends Model{
    protected $fillable = [
        'fecha',
        'hora',
        'sede',
        'estado',
        'doctor_id',
        'especialidad_id'
    ];

    // Relacion (N:1) con la tabla de Doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    
    // Relacion (N:1) con la tabla de Especialidad
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }
}
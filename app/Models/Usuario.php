<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model {
    protected $fillable = [
        'correo',
        'contrasena',
        'rol_id',

    ];

    // Relación N-1 con Rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }
    
    // Relación 1-1 con Paciente
    public function paciente()
    {
        return $this->hasOne(Paciente::class, 'usuario_id');
    }
}

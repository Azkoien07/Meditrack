<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable {
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'correo',
        'contraseña',
        'rol_id',
    ];

    protected $hidden = [
        'contraseña',
    ];

    // Hasheado automático de contraseña
    public function setContrasenaAttribute($value)
    {
        $this->attributes['contraseña'] = bcrypt($value);
    }

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

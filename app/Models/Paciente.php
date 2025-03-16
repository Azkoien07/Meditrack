<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = [
        'nombre',
        'apellido',
        'edad',
        'genero',
        'telefono',
        'tipo_identificacion',
        'identificacion',
        'eps',
        'f_nacimiento',
        'usuario_id' // Asegúrate de incluir usuario_id en el fillable
    ];

    // Relación (1-1) con Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    // Relación (1-N) con Citas
    public function citas()
    {
        return $this->hasMany(Citas::class, 'paciente_id');
    }
}
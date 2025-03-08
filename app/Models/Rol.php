<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    
    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
    ];

    // Relación uno a muchos (1-N) con el modelo Usuario
    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }
}
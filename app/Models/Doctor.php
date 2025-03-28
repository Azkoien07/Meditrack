<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model{
    protected $table = 'doctores';
    
    protected $fillable =[
        'nombre',
        'apellido',
        'genero',
        'turno',
        'usuario_id',
    ];

    // Relación (1-1) con Usuario
    public function usuario(){
        return $this->belongsTo(Usuario::class,'usuario_id');
    }
    
    // Relación (M-N) con Especialidad
    public function especialidad(){
        return $this->belongsToMany(Especialidad::class, 'especialidad_id');
    }
}

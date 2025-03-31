<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
    public function especialidades(): BelongsToMany {
        return $this->belongsToMany(Especialidad::class, 'doctor_especialidad', 'doctor_id', 'especialidad_id')->withTimestamps();
    }
}

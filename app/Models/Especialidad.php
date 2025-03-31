<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model{
    protected $table = 'especialidades';
    use HasFactory;
    protected $fillable = [
        'cod_especialidad',
        'nombre',
        'descripcion'
    ];
       // Relación muchos a muchos con Doctor
       public function doctores()
       {
           return $this->belongsToMany(Doctor::class, 'doctor_especialidad', 'especialidad_id', 'doctor_id');
       }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombre', 'email', 'telefono' // Agrega aquí los campos que necesites
    ];
}

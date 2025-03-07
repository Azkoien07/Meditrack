<?php

namespace App\Contracs;

use App\Models\Doctor;

interface DoctorServiceInterface{
    
    // Listar doctores
    public function listarDoctores();

    // Crear doctor
    public function crearDoctor(array $data);

    // Obtener doctor (id)
    public function obtenerDoctor(int $id);

    // Actualizar doctor (id)
    public function actualizarDoctor(array $data, int $id);

    // Desactivar doctor
    public function eliminarDoctor(Doctor $doctor);
}
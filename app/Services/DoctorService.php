<?php

namespace App\Services;

use App\Contracs\DoctorServiceInterface;
use App\Models\Doctor;

class DoctorService implements DoctorServiceInterface{
    // Metodos Crud
    public function listarDoctores(){
        return Doctor::all();
    }

    public function crearDoctor(array $data){
        return Doctor::create($data);
    }

    public function obtenerDoctor(int $id){
        return Doctor::find($id);
    }

    public function actualizarDoctor(array $data, int $id){
        $doctor = Doctor::find($id);
        $doctor->update($data);
        return $doctor;
    }

    public function eliminarDoctor(Doctor $doctor){
        return $doctor->delete();
    }

}
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorEspecialidadController;
use App\Http\Controllers\EspecialidadController;

// Página de inicio (Login)
Route::get('/', function () {
    return view('auth.login');
});

// Autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registro de usuarios
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Rutas protegidas con middleware según el rol
Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::delete('/admin/eliminar/{id}', [AdminController::class, 'eliminar'])->name('admin.eliminar');
    Route::get('/admin/editar/{id}', [AdminController::class, 'editar'])->name('admin.editar');
    Route::put('/admin/actualizar/{id}', [AdminController::class, 'actualizar'])->name('admin.actualizar');
    Route::get('/admin/descargar-reporte/{id}', [AdminController::class, 'descargarReporte'])->name('admin.descargar.reporte');
    Route::post('/admin/asignar-especialidad/{doctor}', [AdminController::class, 'asignarEspecialidad'])->name('admin.asignarEspecialidad');
});

Route::get('/doctores/create', [DoctorController::class, 'create'])->name('Doctor.createD');
Route::post('/doctores', [DoctorController::class, 'store'])->name('doctores.store');


Route::middleware([RoleMiddleware::class . ':doctor'])->group(function () {
    Route::get('/doctor', [DoctorController::class, 'index'])->name('doctor');
    Route::get('/doctor/pacientes', [DoctorController::class, 'verPacientes'])->name('doctor.pacientes');
});


Route::middleware([RoleMiddleware::class . ':paciente'])->group(function () {
    Route::get('/paciente', [CitasController::class, 'index'])->name('paciente');
});

//  Rutas para gestión de citas
Route::get('/citas', [CitasController::class, 'index'])->name('citas.index');
Route::post('/citas', [CitasController::class, 'store'])->name('citas.store');

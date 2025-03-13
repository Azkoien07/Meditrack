<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\CitasController;


Route::get('/', function () {
    return view('auth.login');
});

// Ruta para mostrar el formulario de login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Ruta para procesar el formulario de login
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// Ruta para cerrar sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas con el middleware
Route::get('/admin', function () {
    return view('Admin.indexA');
})->middleware(RoleMiddleware::class . ':admin')->name('admin');

Route::get('/doctor', function () {
    return view('Doctor.indexD');
})->middleware(RoleMiddleware::class . ':doctor')->name('doctor');

Route::get('/paciente', function () {
    return view('Paciente.indexP');
})->middleware(RoleMiddleware::class . ':paciente')->name('paciente');

// Ruta para el modal de registro
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Ruta para la auntenticacion desde la BD
Route::post('/authenticate', [RolesController::class, 'authenticate'])->name('authenticate');

// Ruta para alimentar la vista del admin
Route::get('/admin', [AdminController::class, 'index'])
    ->middleware(RoleMiddleware::class . ':admin')
    ->name('admin');

    // Ruta para agendar cita
Route::get('/paciente', [CitasController::class, 'index'])
    ->middleware(RoleMiddleware::class . ':paciente')
    ->name('paciente');

// Rutas para alimentar la vista de pacientes (Calendario)
Route::get('/citas', [CitasController::class, 'index'])->name('citas.index');
Route::post('/citas', [CitasController::class, 'store'])->name('citas.store');

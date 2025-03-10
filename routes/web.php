<?php

use App\Http\Controllers\PacienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AdminController;


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
})->middleware(RoleMiddleware::class.':admin')->name('admin');

Route::get('/doctor', function () {
    return view('Doctor.indexD');
})->middleware(RoleMiddleware::class.':doctor')->name('doctor');

Route::get('/paciente', function () {
    return view('Paciente.indexP'); // Vista para Paciente
})->middleware(RoleMiddleware::class.':paciente')->name('paciente');

Route::post('/register', [AuthController::class, 'register'])->name('register');

// Ruta para alimentar la vista del admin
Route::get('/admin', [AdminController::class, 'index'])
    ->middleware(RoleMiddleware::class.':admin')
    ->name('admin');
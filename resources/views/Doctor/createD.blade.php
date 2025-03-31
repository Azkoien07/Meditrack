@extends('Layouts.App')
@section('content')

<head>
    <title>Crear Doctor</title>
</head>
<div class="min-h-screen bg-gradient-to-r from-blue-50 to-purple-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl w-full bg-white rounded-2xl shadow-2xl p-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Agregar Nuevo Doctor</h1>

        <!-- Formulario -->
        <form id="formDoctor" action="{{ route('doctores.store') }}" method="POST" class="space-y-6">
            @csrf
            <!-- Campos para la tabla usuarios -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="rol_register" class="block text-sm font-medium text-gray-700 mb-2">Rol</label>
                    <select name="rol" id="rol_register" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" disabled>
                        <option value="doctor" selected>Doctor</option>
                    </select>
                </div>
                <div>
                    <label for="correo" class="block text-sm font-medium text-gray-700 mb-2">Correo Electrónico</label>
                    <input type="email" name="correo" id="correo" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" placeholder="ejemplo@correo.com" required>
                </div>
                <div>
                    <label for="contraseña" class="block text-sm font-medium text-gray-700 mb-2">Contraseña</label>
                    <input type="password" name="contraseña" id="contraseña" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" placeholder="********" required>
                </div>
            </div>

            <!-- Campos para la tabla Doctores -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" placeholder="Nombre del doctor" required>
                </div>
                <div>
                    <label for="apellido" class="block text-sm font-medium text-gray-700 mb-2">Apellido</label>
                    <input type="text" name="apellido" id="apellido" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" placeholder="Apellido del doctor">
                </div>
                <div>
                    <label for="genero" class="block text-sm font-medium text-gray-700 mb-2">Género</label>
                    <select name="genero" id="genero" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>
                <div>
                    <label for="turno" class="block text-sm font-medium text-gray-700 mb-2">Turno</label>
                    <select required name="turno" id="turno" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                        <option value="mañana">Mañana</option>
                        <option value="tarde">Tarde</option>
                        <option value="noche">Noche</option>
                    </select>
                </div>
            </div>

            <!-- Botón de envío -->
            <div class="mt-8">
                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 px-6 rounded-lg hover:from-blue-700 hover:to-purple-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all transform hover:scale-105">
                    Guardar Doctor
                </button>
            </div>
        </form>
    </div>
    @endsection
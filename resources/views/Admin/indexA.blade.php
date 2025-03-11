@extends('layouts.app')

@section('content')
<title>Admin</title>
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Panel de Administración</h1>

    <!-- Tarjetas de Información -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white shadow-md rounded-lg p-4 border-l-4 border-green-500">
            <h2 class="text-xl font-semibold text-gray-700">Pacientes Registrados</h2>
            <p class="text-3xl font-bold text-gray-900">{{ $pacientes->count() }}</p>
        </div>
        <div class="bg-white shadow-md rounded-lg p-4 border-l-4 border-blue-500">
            <h2 class="text-xl font-semibold text-gray-700">Doctores Registrados</h2>
            <p class="text-3xl font-bold text-gray-900">{{ $doctores->count() }}</p>
        </div>
        <div class="bg-white shadow-md rounded-lg p-4 border-l-4 border-purple-500">
            <h2 class="text-xl font-semibold text-gray-700">Especialidades Médicas</h2>
            <p class="text-3xl font-bold text-gray-900">--</p>
        </div>
    </div>

    <!-- Tabla de Pacientes -->
    <div class="bg-white shadow-md rounded-lg p-4 mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Lista de Pacientes</h2>
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Correo</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Fecha Registro</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pacientes as $paciente)
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2">{{ $paciente->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $paciente->correo }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $paciente->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tabla de Doctores y Asignación de Especialidades -->
    <div class="bg-white shadow-md rounded-lg p-4">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Lista de Doctores</h2>
        <table class="w-full border-collapse border border-gray-300 mb-4">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Correo</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Especialidad</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($doctores as $doctor)
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2">{{ $doctor->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $doctor->correo }}</td>
                        <td class="border border-gray-300 px-4 py-2">--</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <select class="border rounded p-1">
                                <option>Seleccionar</option>
                                <option>Pediatría</option>
                                <option>Psiquiatría</option>
                                <option>Cardiología</option>
                                <option>Dermatología</option>
                                <option>Oftalmología</option>
                                <option>Neurología</option>
                                <option>Oncología</option>
                                <option>Odontología</option>
                                </select>
                            <button class="bg-blue-500 text-white px-3 py-1 rounded ml-2">Asignar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

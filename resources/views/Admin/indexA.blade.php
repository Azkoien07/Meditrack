@extends('Layouts.App')

@section('content')
<title>Admin</title>
<div class="container mx-auto p-4 sm:p-6">
    <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-4 sm:mb-6">Panel de Administración</h1>
    @if (session('error'))
    <div class="bg-red-500 text-white p-3 rounded-lg mb-4 text-center">
        {{ session('error') }}
    </div>
    @endif

    <!-- Tarjetas de Información -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6">
        <div class="bg-white shadow-md rounded-lg p-4 border-l-4 border-green-500">
            <h2 class="text-lg sm:text-xl font-semibold text-gray-700">Pacientes Registrados</h2>
            <p class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $pacientes->count() }}</p>
        </div>
        <div class="bg-white shadow-md rounded-lg p-4 border-l-4 border-blue-500">
            <h2 class="text-lg sm:text-xl font-semibold text-gray-700">Doctores Registrados</h2>
            <p class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $doctores->count() }}</p>
        </div>
        <div class="bg-white shadow-md rounded-lg p-4 border-l-4 border-purple-500">
            <h2 class="text-lg sm:text-xl font-semibold text-gray-700">Especialidades Médicas</h2>
            <p class="text-2xl sm:text-3xl font-bold text-gray-900">--</p>
        </div>
    </div>

    <!-- Tabla de Pacientes -->
    <div class="bg-white shadow-md rounded-lg p-4 mb-6 overflow-x-auto">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Lista de Pacientes</h2>
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-3 py-2 sm:px-4 sm:py-2 text-left">ID</th>
                    <th class="border border-gray-300 px-3 py-2 sm:px-4 sm:py-2 text-left">Correo</th>
                    <th class="border border-gray-300 px-3 py-2 sm:px-4 sm:py-2 text-left">Fecha Registro</th>
                    <th class="border border-gray-300 px-3 py-2 sm:px-4 sm:py-2 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pacientes as $paciente)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 px-3 py-2 sm:px-4 sm:py-2">{{ $paciente->id }}</td>
                    <td class="border border-gray-300 px-3 py-2 sm:px-4 sm:py-2">
                        {{ $paciente->usuario->correo ?? 'Sin correo' }}
                    </td>
                    <td class="border border-gray-300 px-3 py-2 sm:px-4 sm:py-2">{{ $paciente->created_at->format('d/m/Y') }}</td>
                    <td class="border border-gray-300 px-3 py-2 sm:px-4 sm:py-2">
                        <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                            <a href="{{ route('admin.descargar.reporte', $paciente->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                Descargar Reporte
                            </a>
                            <a href="{{ route('admin.editar', $paciente->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm sm:text-base transition-all hover:bg-yellow-600">Editar</a>
                            <form action="{{ route('admin.eliminar', $paciente->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded text-sm sm:text-base transition-all hover:bg-red-600" type="submit" onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tabla de Doctores y Asignación de Especialidades -->
    <div class="bg-white shadow-md rounded-lg p-4 overflow-x-auto">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Lista de Doctores</h2>
        <a href="{{ route('Doctor.createD') }}" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">Agregar Doctor</a>
        <table class="w-full border-collapse border border-gray-300 mb-4">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-3 py-2 sm:px-4 sm:py-2 text-left">ID</th>
                    <th class="border border-gray-300 px-3 py-2 sm:px-4 sm:py-2 text-left">Correo</th>
                    <th class="border border-gray-300 px-3 py-2 sm:px-4 sm:py-2 text-left">Especialidad</th>
                    <th class="border border-gray-300 px-3 py-2 sm:px-4 sm:py-2 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($doctores as $doctor)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 px-3 py-2 sm:px-4 sm:py-2">{{ $doctor->id }}</td>
                    <td class="border border-gray-300 px-3 py-2 sm:px-4 sm:py-2">
                        {{ $doctor->usuario->correo ?? 'Sin correo' }}
                    </td>
                    <td class="border border-gray-300 px-3 py-2 sm:px-4 sm:py-2">--</td>
                    <td class="border border-gray-300 px-3 py-2 sm:px-4 sm:py-2">
                        <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                            <select class="border rounded p-1 text-sm sm:text-base">
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
                            <button class="bg-blue-500 text-white px-3 py-1 rounded text-sm sm:text-base transition-all hover:bg-blue-600">Asignar</button>
                            <a href="{{ route('admin.editar', $doctor->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm sm:text-base transition-all hover:bg-yellow-600">Editar</a>
                            <form action="{{ route('admin.eliminar', $doctor->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded text-sm sm:text-base transition-all hover:bg-red-600" type="submit" onclick="return confirm('¿Seguro que deseas eliminar este doctor?')">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
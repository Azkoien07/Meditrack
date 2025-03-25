@extends('Layouts.App')

@section('content')
<div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Editar Doctor</h1>

    <form action="{{ route('admin.actualizar', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nombre" class="block text-gray-700 font-medium mb-1">Nombre</label>
            <input type="text" name="nombre" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $persona->nombre }}" required>
        </div>

        <div class="mb-4">
            <label for="apellido" class="block text-gray-700 font-medium mb-1">Apellido</label>
            <input type="text" name="apellido" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $persona->apellido }}" required>
        </div>

        <div class="mb-4">
            <label for="genero" class="block text-gray-700 font-medium mb-1">Género</label>
            <select name="genero" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white" required>
                <option value="masculino" {{ $persona->genero === 'masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="femenino" {{ $persona->genero === 'femenino' ? 'selected' : '' }}>Femenino</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="turno" class="block text-gray-700 font-medium mb-1">Turno</label>
            <select name="turno" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white" required>
                <option value="mañana" {{ $persona->turno === 'mañana' ? 'selected' : '' }}>Mañana</option>
                <option value="tarde" {{ $persona->turno === 'tarde' ? 'selected' : '' }}>Tarde</option>
                <option value="noche" {{ $persona->turno === 'noche' ? 'selected' : '' }}>Noche</option>
            </select>
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
            Actualizar
        </button>
    </form>
</div>
@endsection

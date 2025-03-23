@extends('Layouts.App')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Editar Doctor</h1>
    <form action="{{ route('admin.actualizar', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="nombre" id="nombre" class="block text-gray-700">Nombre</label>
            <input type="text" name="nombre" class="w-full px-3 py-2 border rounded-lg" value="{{ $persona->nombre }}" required>
        </div>

        <div class="mb-4">
            <label for="apellido" id="apellido" class="block text-gray-700">Apellido</label>
            <input type="text" name="apellido" class="w-full px-3 py-2 border rounded-lg" value="{{ $persona->apellido }}" required>
        </div>

        <div class="mb-4">
            <label for="genero" id="genero" class="block text-gray-700">Género</label>
            <select name="genero" class="w-full px-3 py-2 border rounded-lg" required>
                <option value="masculino" {{ $persona->genero === 'masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="femenino" {{ $persona->genero === 'femenino' ? 'selected' : '' }}>Femenino</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="turno" id="turno" class="block text-gray-700">Turno</label>
            <select name="turno" class="w-full px-3 py-2 border rounded-lg" required>
                <option value="mañana" {{ $persona->turno === 'mañana' ? 'selected' : '' }}>Mañana</option>
                <option value="tarde" {{ $persona->turno === 'tarde' ? 'selected' : '' }}>Tarde</option>
                <option value="noche" {{ $persona->turno === 'noche' ? 'selected' : '' }}>Noche</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Actualizar
        </button>
    </form>
</div>
@endsection
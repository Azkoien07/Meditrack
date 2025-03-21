@extends('Layouts.App')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 shadow-md rounded-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Editar Registro</h2>

    <form action="{{ route('admin.actualizar', $persona->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ $persona->nombre }}" required
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido</label>
            <input type="text" name="apellido" id="apellido" value="{{ $persona->apellido }}"
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="edad" class="block text-sm font-medium text-gray-700">Edad</label>
            <input type="number" name="edad" id="edad" value="{{ $persona->edad }}" required
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="genero" class="block text-sm font-medium text-gray-700">Género</label>
            <select name="genero" id="genero" required
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="Masculino" {{ $persona->genero == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="Femenino" {{ $persona->genero == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                <option value="Otro" {{ $persona->genero == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>

        <div>
            <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
            <input type="text" name="telefono" id="telefono" value="{{ $persona->telefono }}"
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="tipo_identificacion" class="block text-sm font-medium text-gray-700">Tipo de Identificación</label>
            <select name="tipo_identificacion" id="tipo_identificacion" required
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @foreach(['CC', 'CE', 'TI', 'RC', 'PA', 'MS', 'NIT'] as $tipo)
                <option value="{{ $tipo }}" {{ $persona->tipo_identificacion == $tipo ? 'selected' : '' }}>
                    {{ $tipo }}
                </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="identificacion" class="block text-sm font-medium text-gray-700">Identificación</label>
            <input type="text" name="identificacion" id="identificacion" value="{{ $persona->identificacion }}" required
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="eps" class="block text-sm font-medium text-gray-700">EPS</label>
            <input type="text" name="eps" id="eps" value="{{ $persona->eps }}" required
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="f_nacimiento" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
            <input type="date" name="f_nacimiento" id="f_nacimiento" value="{{ $persona->f_nacimiento }}" required
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow hover:bg-blue-700 transition">
                Actualizar
            </button>
        </div>
    </form>
</div>
@endsection
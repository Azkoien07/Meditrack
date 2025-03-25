@extends('Layouts.App')

@section('content')
    <h2 class="text-xl font-bold mb-4">Asignar Especialidad a Doctores</h2>

    {{-- Tabla de doctores con opciones de especialidad --}}
    <table class="table-auto w-full border-collapse border border-gray-200 mt-4">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Doctor</th>
                <th class="border px-4 py-2">Especialidades</th>
                <th class="border px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($doctores as $doctor)
                <tr>
                    <td class="border px-4 py-2">{{ $doctor->nombre }}</td>
                    <td class="border px-4 py-2">
                        @if ($doctor->especialidades->isEmpty())
                            <span class="text-gray-500">No asignadas</span>
                        @else
                            {{ $doctor->especialidades->pluck('nombre')->implode(', ') }}
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                            {{-- Selector de especialidades --}}
                            <form action="{{ route('asignar.especialidad') }}" method="POST">
                                @csrf
                                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                                <select name="especialidad_id" class="border rounded p-1 text-sm sm:text-base">
                                    <option value="">Seleccionar</option>
                                    @foreach ($especialidades as $especialidad)
                                        <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded text-sm sm:text-base transition-all hover:bg-blue-600">Asignar</button>
                            </form>

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
@endsection

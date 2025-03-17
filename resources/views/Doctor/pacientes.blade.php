<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pacientes</title>
    <!-- Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    <!-- Barra de navegación -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="#" class="text-2xl font-bold text-blue-600">Doctor</a>
                <button class="text-gray-600 lg:hidden focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
                <div class="hidden lg:flex space-x-4">
                    <a href="{{ route('doctor') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-lg transition-all">Inicio</a>
                    <form action="{{ route('logout') }}" method="POST" class="flex items-center">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-all">Cerrar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container mx-auto px-4 py-8 flex-grow">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-green-600 p-6">
                    <h3 class="text-2xl font-bold text-white">Lista de Pacientes</h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 mb-6">Aquí puedes ver todos los pacientes asociados.</p>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                            <thead>
                                <tr class="bg-green-600 text-white uppercase text-sm leading-normal">
                                    <th class="py-3 px-4 text-left">ID</th>
                                    <th class="py-3 px-4 text-left">Nombre</th>
                                    <th class="py-3 px-4 text-left">Apellido</th>
                                    <th class="py-3 px-4 text-left">Edad</th>
                                    <th class="py-3 px-4 text-left">Género</th>
                                    <th class="py-3 px-4 text-left">Teléfono</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 text-sm">
                                @forelse ($pacientes as $paciente)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100 transition">
                                        <td class="py-3 px-4">{{ $paciente->id }}</td>
                                        <td class="py-3 px-4">{{ $paciente->nombre }}</td>
                                        <td class="py-3 px-4">{{ $paciente->apellido }}</td>
                                        <td class="py-3 px-4">{{ $paciente->edad }}</td>
                                        <td class="py-3 px-4">{{ $paciente->genero }}</td>
                                        <td class="py-3 px-4">{{ $paciente->telefono }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-3 px-4 text-center text-gray-500">No hay pacientes registrados.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie de página -->
    <footer class="bg-white shadow-md py-4 mt-auto">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-600 mb-0">&copy; 2025 MediTrack. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>

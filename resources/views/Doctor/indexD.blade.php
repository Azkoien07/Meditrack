<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Doctor</title>
    <!-- Tailwind CSS -->
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
                    <a href="#" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-lg transition-all">Inicio</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-lg transition-all">Citas</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-lg transition-all">Configuración</a>
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
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-blue-600 p-6">
                    <h3 class="text-2xl font-bold text-white">Bienvenido, Doctor</h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 mb-6">Aquí puedes gestionar tus pacientes, citas y más.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-all">Ver Citas</a>
                        <a href="#" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-all">Ver Pacientes</a>
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
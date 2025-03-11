<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">
<nav class="bg-blue-500 text-white p-4 flex justify-between items-center shadow-md">
    <h1 class="text-2xl font-bold tracking-wide">MediTrack</h1>
    
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit"
            class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300 shadow-md flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 002 2h3a2 2 0 002-2v-1m-7-4v-3a2 2 0 012-2h3a2 2 0 012 2v3"></path>
            </svg>
            Cerrar Sesión
        </button>
    </form>
</nav>
    <div class="container mx-auto mt-4">
        @yield('content')
    </div>
</body>

</html>
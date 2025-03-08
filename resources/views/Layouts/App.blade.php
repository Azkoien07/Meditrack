<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Aplicación')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-500 text-white p-4">
        <h1 class="text-xl font-bold">Mi Aplicación</h1>
    </nav>
    <div class="container mx-auto mt-4">
        @yield('content')
    </div>
</body>
</html>

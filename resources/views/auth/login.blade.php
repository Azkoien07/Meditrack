<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MediTrack</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-r from-blue-50 to-purple-50 flex flex-col items-center justify-center min-h-screen p-4">
    <h1 class="text-5xl font-bold text-gray-800 mb-8 text-center">Bienvenidos a <span class="text-blue-600">MediTrack</span></h1>

    <div class="bg-white rounded-xl shadow-2xl p-8 w-full max-w-md">
        <h3 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Iniciar Sesión</h3>

        <!-- Mensajes de error -->
        @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Formulario de inicio de sesión -->
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="rol" class="block text-sm font-medium text-gray-700 mb-2">Selecciona tu Rol</label>
                <select name="rol" id="rol_login" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    <option value="admin">Administrador</option>
                    <option value="doctor">Doctor</option>
                    <option value="paciente">Paciente</option>
                </select>
            </div>

            <div class="mb-6">
                <label for="correo" class="block text-sm font-medium text-gray-700 mb-2">Correo Electrónico</label>
                <input type="email" name="correo" id="correo_login" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required autofocus>
            </div>

            <div class="mb-6">
                <label for="contraseña" class="block text-sm font-medium text-gray-700 mb-2">Contraseña</label>
                <input type="password" name="contraseña" id="contraseña_login" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                Iniciar Sesión
            </button>
        </form>

        <!-- Enlace para registro -->
        <div class="mt-6 text-center">
            <p class="text-gray-600">¿No tienes una cuenta? <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal" class="text-blue-600 hover:underline">Regístrate aquí</a></p>
        </div>
    </div>

    <!-- Modal de Registro -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-blue-600 text-white p-6 rounded-t-xl">
                    <h5 class="modal-title text-2xl font-bold" id="registerModalLabel">Registro de Paciente</h5>
                    <button type="button" class="btn-close bg-white rounded-full p-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-6">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Campos del usuario -->
                            <div class="mb-4">
                                <label for="rol_register" class="block text-sm font-medium text-gray-700 mb-2">Rol</label>
                                <select name="rol" id="rol_register" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" disabled>
                                    <option value="paciente" selected>Paciente</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="correo_register" class="block text-sm font-medium text-gray-700 mb-2">Correo Electrónico</label>
                                <input type="email" name="correo" id="correo_register" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
                            </div>

                            <div class="mb-4">
                                <label for="contraseña_register" class="block text-sm font-medium text-gray-700 mb-2">Contraseña</label>
                                <input type="password" name="contraseña" id="contraseña_register" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
                            </div>

                            <div class="mb-4">
                                <label for="contraseña_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirmar Contraseña</label>
                                <input type="password" name="contraseña_confirmation" id="contraseña_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
                            </div>

                            <!-- Campos del paciente -->
                            <div class="mb-4">
                                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
                            </div>

                            <div class="mb-4">
                                <label for="apellido" class="block text-sm font-medium text-gray-700 mb-2">Apellido</label>
                                <input type="text" name="apellido" id="apellido" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                            </div>

                            <div class="mb-4">
                                <label for="edad" class="block text-sm font-medium text-gray-700 mb-2">Edad</label>
                                <input type="text" name="edad" id="edad" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
                            </div>

                            <div class="mb-4">
                                <label for="genero" class="block text-sm font-medium text-gray-700 mb-2">Género</label>
                                <select name="genero" id="genero" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="telefono" class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                                <input type="text" name="telefono" id="telefono" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                            </div>

                            <div class="mb-4">
                                <label for="tipo_identificacion" class="block text-sm font-medium text-gray-700 mb-2">Tipo de Identificación</label>
                                <select name="tipo_identificacion" id="tipo_identificacion" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
                                    <option value="CC">Cédula de Ciudadanía (CC)</option>
                                    <option value="CE">Cédula de Extranjería (CE)</option>
                                    <option value="TI">Tarjeta de Identidad (TI)</option>
                                    <option value="RC">Registro Civil (RC)</option>
                                    <option value="PA">Pasaporte (PA)</option>
                                    <option value="MS">Menor Sin Identificación (MS)</option>
                                    <option value="NIT">NIT</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="identificacion" class="block text-sm font-medium text-gray-700 mb-2">Número de Identificación</label>
                                <input type="text" name="identificacion" id="identificacion" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
                            </div>

                            <div class="mb-4">
                                <label for="eps" class="block text-sm font-medium text-gray-700 mb-2">EPS</label>
                                <input type="text" name="eps" id="eps" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
                            </div>

                            <div class="mb-4">
                                <label for="f_nacimiento" class="block text-sm font-medium text-gray-700 mb-2">Fecha de Nacimiento</label>
                                <input type="date" name="f_nacimiento" id="f_nacimiento" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                                Registrarse
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
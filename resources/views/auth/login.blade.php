<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        h1 {
            margin-bottom: 1.5rem;
            font-size: 2.8rem;
            font-weight: bold;
            color: #333;
            text-align: center;
        }

        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            border-radius: 10px;
            background: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .register-link {
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>

<body>

    <h1>Bienvenidos a MediTrack</h1>

    <div class="login-container">
        <h3 class="text-center mb-4">Iniciar Sesión</h3>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="rol" class="form-label">Selecciona tu Rol</label>
                <select name="rol" id="rol_login" class="form-control" required>
                    <option value="admin">Administrador</option>
                    <option value="doctor">Doctor</option>
                    <option value="paciente">Paciente</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" name="correo" id="correo_login" class="form-control" required autofocus>
            </div>

            <div class="mb-3">
                <label for="contraseña" class="form-label">Contraseña</label>
                <input type="password" name="contraseña" id="contraseña_login" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
        </form>

        <div class="register-link">
            <p>¿No tienes una cuenta? <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Regístrate aquí</a></p>
        </div>
    </div>

    <!-- Modal de Registro -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Registro de Paciente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="rol_register" class="form-label">Rol</label>
                            <select name="rol" id="rol_register" class="form-control" disabled>
                                <option value="paciente" selected>Paciente</option>
                            </select>
                        </div>
                        
                        <!-- Campos del usuario -->
                        <div class="mb-3">
                            <label for="correo_register" class="form-label">Correo Electrónico</label>
                            <input type="email" name="correo" id="correo_register" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="contraseña_register" class="form-label">Contraseña</label>
                            <input type="password" name="contraseña" id="contraseña_register" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="contraseña_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input type="password" name="contraseña_confirmation" id="contraseña_confirmation" class="form-control" required>
                        </div>

                        <!-- Campos del paciente -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" name="apellido" id="apellido" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="edad" class="form-label">Edad</label>
                            <input type="text" name="edad" id="edad" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="genero" class="form-label">Género</label>
                            <select name="genero" id="genero" class="form-control" required>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="tipo_identificacion" class="form-label">Tipo de Identificación</label>
                            <select name="tipo_identificacion" id="tipo_identificacion" class="form-control" required>
                                <option value="CC">Cédula de Ciudadanía (CC)</option>
                                <option value="CE">Cédula de Extranjería (CE)</option>
                                <option value="TI">Tarjeta de Identidad (TI)</option>
                                <option value="RC">Registro Civil (RC)</option>
                                <option value="PA">Pasaporte (PA)</option>
                                <option value="MS">Menor Sin Identificación (MS)</option>
                                <option value="NIT">NIT</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="identificacion" class="form-label">Número de Identificación</label>
                            <input type="text" name="identificacion" id="identificacion" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="eps" class="form-label">EPS</label>
                            <input type="text" name="eps" id="eps" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="f_nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" name="f_nacimiento" id="f_nacimiento" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Registrarse</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
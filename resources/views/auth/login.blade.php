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
            margin-bottom: 1.5rem; /* Separación del formulario */
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
    </style>
</head>
<body>

<h1>Bienvenidos a MediTrack</h1>

<div class="login-container">
    <h3 class="text-center mb-4">Iniciar Sesión</h3>

    {{-- Mostrar errores de autenticación --}}
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

        {{-- Selección de Rol --}}
        <div class="mb-3">
            <label for="role" class="form-label">Selecciona tu Rol</label>
            <select name="role" id="role" class="form-control" required>
                <option value="admin">Administrador</option>
                <option value="doctor">Doctor</option>
                <option value="paciente">Paciente</option>
            </select>
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" name="email" id="email" class="form-control" required autofocus>
        </div>

        {{-- Password --}}
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        {{-- Botón de Login --}}
        <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

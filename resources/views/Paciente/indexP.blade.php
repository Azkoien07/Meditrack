<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">MediTrack</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Citas Médicas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Historial</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Cerrar Sesión</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card shadow-sm p-4">
            <h2 class="text-center mb-4">Bienvenido, Paciente</h2>
            <p class="text-center">Aquí puedes gestionar tus citas médicas, consultar tu historial y más.</p>

            <div class="row text-center">
                <div class="col-md-4">
                    <a href="#" class="btn btn-success w-100 mb-2">Agendar Cita</a>
                </div>
                <div class="col-md-4">
                    <a href="#" class="btn btn-info w-100 mb-2">Ver Historial Médico</a>
                </div>
                <div class="col-md-4">
                    <a href="#" class="btn btn-warning w-100">Actualizar D

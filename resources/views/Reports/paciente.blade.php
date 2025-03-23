<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Pacientes</title>
    <link href="{{ public_path('css/pdf-styles.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px; /* Fuente reducida para evitar cortes */
            color: #333;
            margin: 0;
            padding: 10px;
        }

        h1 {
            font-size: 16px;
            font-weight: bold;
            color: #1f2937;
            text-align: center;
            margin-bottom: 10px;
        }

        .container {
            background-color: white;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 6px;
            width: 100%;
            max-width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* Ajusta el tamaño de las columnas */
            word-wrap: break-word; /* Evita desbordamientos de texto */
        }

        th, td {
            padding: 5px;
            text-align: left;
            border: 1px solid #ddd;
            overflow: hidden;
            font-size: 9px; /* Fuente más pequeña para caber en la hoja */
        }

        thead {
            background-color: #374151;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }

        tbody tr:nth-child(even) {
            background-color: #f3f4f6;
        }

        tbody tr:hover {
            background-color: #e5e7eb;
        }

        .small-text {
            font-size: 8px;
            color: #555;
            text-align: center;
            margin-top: 10px;
        }

        /* Evita que la tabla se corte en la siguiente página */
        table, tr, td, th {
            page-break-inside: avoid;
        }
    </style>
</head>
<body>
    <h1>Reporte de Pacientes</h1>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Edad</th>
                    <th>Género</th>
                    <th>Teléfono</th>
                    <th>Tipo de ID</th>
                    <th>Identificación</th>
                    <th>EPS</th>
                    <th>Fecha de Nacimiento</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $paciente)
                    <tr>
                        <td>{{ $paciente['id'] }}</td>
                        <td>{{ $paciente['nombre'] }}</td>
                        <td>{{ $paciente['apellido'] }}</td>
                        <td>{{ $paciente['edad'] }}</td>
                        <td>{{ $paciente['genero'] }}</td>
                        <td>{{ $paciente['telefono'] }}</td>
                        <td>{{ $paciente['tipo_identificacion'] }}</td>
                        <td>{{ $paciente['identificacion'] }}</td>
                        <td>{{ $paciente['eps'] }}</td>
                        <td>{{ $paciente['f_nacimiento'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p class="small-text">Generado automáticamente el {{ date('d/m/Y') }}</p>
    </div>
</body>
</html>

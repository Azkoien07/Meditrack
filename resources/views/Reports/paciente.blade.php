<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Pacientes</title>
    <link href="{{ public_path('css/pdf-styles.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
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
            table-layout: fixed;
            word-wrap: break-word;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
            border: 1px solid #ddd;
            overflow: hidden;
            font-size: 9px;
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

        table,
        tr,
        td,
        th {
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
                <tr>
                    <td>{{ $data['id'] }}</td>
                    <td>{{ $data['nombre'] }}</td>
                    <td>{{ $data['apellido'] }}</td>
                    <td>{{ $data['edad'] }}</td>
                    <td>{{ $data['genero'] }}</td>
                    <td>{{ $data['telefono'] }}</td>
                    <td>{{ $data['tipo_identificacion'] }}</td>
                    <td>{{ $data['identificacion'] }}</td>
                    <td>{{ $data['eps'] }}</td>
                    <td>{{ $data['f_nacimiento'] }}</td>
                </tr>
        </table>
        <p class="small-text">Generado automáticamente el {{ date('d/m/Y') }}</p>
    </div>
</body>

</html>
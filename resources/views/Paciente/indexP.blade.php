<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Paciente</title>
    <!-- Importaciones -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arbutus&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.js"></script>

    <style>
        body {
            background-color: #f4f6f9;
        }

        .container {
            max-width: 900px;
        }

        

        .fc, h2 ,p{
            font-family: 'Merriweather', serif;
        }

        .fc-daygrid-day-number {
            font-size: 14px;
            font-weight: bold;
        }

        .fc-toolbar-title {
            font-size: 22px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">MediTrack</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="btn  text-white px-3 py-2" href="#">Citas Médicas</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn text-white px-3 py-2" href="#">Descargar Historial</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-flex align-items-center">
                            @csrf
                            <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <div class="container mt-5">
        <div class="card shadow-sm p-4">
            <h2 class="text-center mb-4">Bienvenido, Paciente</h2>
            <p class="text-center">Aquí puedes gestionar tus citas médicas y consultar tu historial.</p>

            <div id="calendar"></div>
        </div>
    </div>

    <!-- Modal para agendar cita -->
    <div class="modal fade" id="modalCita" tabindex="-1" aria-labelledby="modalCitaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCitaLabel">Agendar Cita Médica</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form id="formCita">
                        @csrf
                        <input type="hidden" id="fechaCita" name="fecha">
                        <div class="mb-3">
                            <label for="horaCita" class="form-label">Hora de la Cita</label>
                            <input type="time" id="horaCita" name="hora" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="motivoCita" class="form-label">Motivo de la Cita</label>
                            <textarea id="motivoCita" name="motivo" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Guardar Cita</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                selectable: true,
                select: function(info) {
                    document.getElementById('fechaCita').value = info.startStr;
                    var modal = new bootstrap.Modal(document.getElementById('modalCita'));
                    modal.show();
                },
                events: "{{ route('citas.index') }}" // Aquí se cargan las citas desde Laravel
            });

            calendar.render();

            // Enviar formulario de cita
            document.getElementById('formCita').addEventListener('submit', function(e) {
                e.preventDefault();
                fetch("{{ route('citas.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        fecha: document.getElementById('fechaCita').value,
                        hora: document.getElementById('horaCita').value,
                        motivo: document.getElementById('motivoCita').value
                    })
                }).then(response => response.json()).then(data => {
                    if (data.success) {
                        calendar.refetchEvents(); // Actualizar el calendario con la nueva cita
                        var modal = bootstrap.Modal.getInstance(document.getElementById('modalCita'));
                        modal.hide();
                    }
                }).catch(error => console.error('Error:', error));
            });
        });
    </script>
</body>

</html>
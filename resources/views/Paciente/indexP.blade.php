<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Paciente</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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



        .fc,
        h2,
        p {
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
                    <form id="formCita" action="{{ route('citas.store') }}" method="POST">
                        @csrf
                        <input type="hidden" id="fechaCita" name="fecha">
                        <div class="mb-3">
                            <label for="horaCita" class="form-label">Hora de la Cita</label>
                            <input type="time" id="horaCita" name="hora" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="sede" class="form-label">Sede de la Cita</label>
                            <select name="sede" id="sede" class="form-control" required>
                                <option value="" disabled selected>Seleccionar</option>
                                <option value="Autopista Sur">Autopista Sur</option>
                                <option value="Av 1 de Mayo">Av 1 de Mayo</option>
                                <option value="Calle 134 Plan Complementario">Calle 134 Plan Complementario</option>
                                <option value="Calle 145 Plan Complementario">Calle 145 Plan Complementario</option>
                                <option value="Calle 153 Plan Complementario">Calle 153 Plan Complementario</option>
                                <option value="Calle 26">Calle 26</option>
                                <option value="Calle 42">Calle 42</option>
                                <option value="Calle 94 Plan Complementario">Calle 94 Plan Complementario</option>
                                <option value="Carrera 69">Carrera 69</option>
                                <option value="Centro Mayor">Centro Mayor</option>
                                <option value="Fontibón">Fontibón</option>
                                <option value="IPS San Martin - Galán">IPS San Martin - Galán</option>
                                <option value="Kennedy I">Kennedy I</option>
                                <option value="Proyecto NQ5 67">Proyecto NQ5 67</option>
                                <option value="Proyecto Torres de Galicia">Proyecto Torres de Galicia</option>
                                <option value="Sede Empresarial">Sede Empresarial</option>
                                <option value="Suba">Suba</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="especialidad" class="form-label">Especialidad</label>
                            <select name="nombre_especialidad" id="especialidad_cita" class="form-control" require>
                                <option value="" disabled selected>Seleccionar</option>
                                <option>Pediatría</option>
                                <option>Psiquiatría</option>
                                <option>Cardiología</option>
                                <option>Dermatología</option>
                                <option>Oftalmología</option>
                                <option>Neurología</option>
                                <option>Oncología</option>
                                <option>Odontología</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="motivoCita" class="form-label">Motivo de la Cita</label>
                            <textarea id="motivoCita" name="motivo" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="doctor_id" class="form-label">Doctor</label>
                            <select id="doctor_id" name="doctor_id" class="form-control" required>
                                <option value="" disabled selected>Seleccionar</option>
                                @foreach($doctores as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Guardar Cita</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de éxito -->
    <div class="modal" id="modalExito" tabindex="-1" aria-labelledby="modalExitoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalExitoLabel">¡Cita Agregada exitosamente!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body text-center">
                    <p>Tu cita se ha registrado correctamente.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Aceptar</button>
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
                events: "{{ route('citas.store') }}"
            });

            calendar.render();

            // Enviar formulario de cita
            document.getElementById('formCita').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = {
                    fecha: document.getElementById('fechaCita').value,
                    hora: document.getElementById('horaCita').value,
                    sede: document.getElementById('sede').value,
                    especialidad: document.getElementById('especialidad_cita').value,
                    motivo: document.getElementById('motivoCita').value,
                    doctor_id: document.getElementById('doctor_id').value
                };

                fetch("{{ route('citas.store') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                        },
                        body: new URLSearchParams(formData)
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.text().then(text => {
                                throw new Error(text);
                            });
                        }
                        return response.text();
                    })
                    .then(html => {
                        console.log("Cita guardada correctamente.");
                        var modalCita = bootstrap.Modal.getInstance(document.getElementById('modalCita'));
                        modalCita.hide();

                        document.getElementById('formCita').reset();

                        document.getElementById('modalCita').addEventListener('hidden.bs.modal', function() {
                            var modalExito = new bootstrap.Modal(document.getElementById('modalExito'));
                            modalExito.show();
                        });

                        // Agregar el evento al calendario
                        calendar.addEvent({
                            title: `${formData.especialidad} - ${formData.hora}`,
                            start: formData.fecha,
                            allDay: true
                        });
                    })
                    .catch(error => {
                        console.error("Error en la solicitud:", error);
                        alert("Ocurrió un error al registrar la cita.");
                    });
            });
        });
    </script>
</body>

</html>
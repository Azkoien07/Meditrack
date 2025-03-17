<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Paciente</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Importaciones -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arbutus&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.js"></script>
    <style>
        body {
            font-family: 'Merriweather', serif;
            background-color: #f4f6f9;
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

<body class="bg-gradient-to-r from-blue-50 to-purple-50">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-blue-600 to-blue-700 shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="#" class="text-white text-2xl font-bold">MediTrack</a>
                <div class="flex space-x-4">
                    <a href="#" class="text-white hover:bg-blue-700 px-3 py-2 rounded-lg transition-all">Descargar Historial</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-all">Cerrar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-2xl p-8">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-4">Bienvenido, Paciente</h2>
            <p class="text-center text-gray-600 mb-8">Aquí puedes gestionar tus citas médicas y consultar tu historial.</p>

            <!-- Calendario -->
            <div id="calendar" class="mb-8"></div>

            <!-- Botón para agendar cita -->
            <div class="text-center">
                <button onclick="openModal()" class="bg-gradient-to-r from-blue-600  to-blue-800 shadow-lg text-white px-6 py-3 rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all transform hover:scale-105">
                    Agendar Nueva Cita
                </button>
            </div>
        </div>
    </div>

    <!-- Modal para agendar cita -->
    <div id="modalCita" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-4 p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800">Agendar Cita Médica</h3>
                <button onclick="closeModal()" class="text-gray-600 hover:text-gray-800 transition-all">
                    &times;
                </button>
            </div>
            <form id="formCita" action="{{ route('citas.store') }}" method="POST">
                @csrf
                <input type="hidden" id="fechaCita" name="fecha">
                <div class="space-y-4">
                    <div>
                        <label for="horaCita" class="block text-sm font-medium text-gray-700">Hora de la Cita</label>
                        <input type="time" id="horaCita" name="hora" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
                    </div>
                    <div>
                        <label for="sede" class="block text-sm font-medium text-gray-700">Sede de la Cita</label>
                        <select name="sede" id="sede" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
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
                    <div>
                        <label for="especialidad" class="block text-sm font-medium text-gray-700">Especialidad</label>
                        <select name="nombre_especialidad" id="especialidad_cita" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
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
                    <div>
                        <label for="motivoCita" class="block text-sm font-medium text-gray-700">Motivo de la Cita</label>
                        <textarea id="motivoCita" name="motivo" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required></textarea>
                    </div>
                    <div>
                        <label for="doctor_id" class="block text-sm font-medium text-gray-700">Doctor</label>
                        <select id="doctor_id" name="doctor_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
                            <option value="" disabled selected>Seleccionar</option>
                            @foreach($doctores as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all transform hover:scale-105">
                        Guardar Cita
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de éxito -->
    <div id="modalExito" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 p-6">
            <div class="text-center">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">¡Cita Agregada Exitosamente!</h3>
                <p class="text-gray-600 mb-6">Tu cita se ha registrado correctamente.</p>
                <button onclick="closeSuccessModal()" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-2 rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all">
                    Aceptar
                </button>
            </div>
        </div>
    </div>

    <script>
        // Funciones para abrir y cerrar modales
        function openModal() {
            document.getElementById('modalCita').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modalCita').classList.add('hidden');
        }

        function closeSuccessModal() {
            document.getElementById('modalExito').classList.add('hidden');
        }

        // Inicializar FullCalendar
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                selectable: true,
                selectAllow: function(selectInfo) {
                    let today = new Date().setHours(0, 0, 0, 0);
                    let selectedDate = new Date(selectInfo.start).setHours(0, 0, 0, 0);
                    return selectedDate >= today;
                },
                dateClick: function(info) {
                    let today = new Date().setHours(0, 0, 0, 0);
                    let clickedDate = new Date(info.dateStr).setHours(0, 0, 0, 0);
                    if (clickedDate < today) {
                        alert("No puedes agendar citas en fechas pasadas.");
                    } else {
                        document.getElementById('fechaCita').value = info.dateStr;
                        openModal();
                    }
                },
                dayCellDidMount: function(info) {
                    let today = new Date().setHours(0, 0, 0, 0);
                    let cellDate = new Date(info.date).setHours(0, 0, 0, 0);

                    if (cellDate < today) {
                        info.el.style.opacity = "0.3";
                    }
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
                    doctor_id: document.getElementById('doctor_id').value,
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
                            throw new Error("Error en la solicitud.");
                        }
                        return response.text();
                    })
                    .then(html => {
                        console.log("Cita guardada correctamente.");
                        closeModal();
                        document.getElementById('formCita').reset();
                        document.getElementById('modalExito').classList.remove('hidden');

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
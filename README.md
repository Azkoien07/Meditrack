# MediTrack - Sistema de Gestión Médica

## 🏥 Descripción
MediTrack es una plataforma moderna e intuitiva diseñada para optimizar la gestión de pacientes, doctores y citas médicas en clínicas y centros de salud. Su objetivo es mejorar la organización del tiempo y la atención al paciente, asegurando un flujo de trabajo eficiente y sin errores.

## 🔧 Tecnologías utilizadas
- **Backend:** PHP con Laravel
- **Frontend:** Blade Templates
- **Base de datos:** PostgreSQL
- **ORM:** Eloquent
- **Autenticación:** Laravel Breeze o Jetstream (según configuración)
- **Gestor de dependencias:** Composer
- **Servidor Web:** Apache o Nginx

## 📄 Características principales
- ✅ Registro, actualización y gestión de pacientes y profesionales de la salud.
- ✅ Administración eficiente de citas médicas, evitando errores y retrasos.
- ✅ Gestión de especialidades médicas para asignar correctamente cada cita.
- ✅ Centralización de la información para un acceso rápido y seguro.
- ✅ Panel de control intuitivo con Blade Templates.
- ✅ Sistema de autenticación y roles de usuario.

## 🚀 Instalación y configuración
### 1. Clonar el repositorio
```bash
 git clone https://github.com/tu-usuario/MediTrack.git
 cd MediTrack
```
### 2. Instalar dependencias
```bash
 composer install
```
### 3. Configurar variables de entorno
Renombra el archivo `.env.example` a `.env` y configúralo según tu entorno.
```bash
 cp .env.example .env
```
Configura la conexión a PostgreSQL en el archivo `.env`:
```env
 DB_CONNECTION=pgsql
 DB_HOST=127.0.0.1
 DB_PORT=5432
 DB_DATABASE=meditrack
 DB_USERNAME=tu_usuario
 DB_PASSWORD=tu_contraseña
```
### 4. Generar clave de aplicación
```bash
 php artisan key:generate
```
### 5. Migrar la base de datos
```bash
php artisan migrate --path=database/migrations/2025_03_06_232041_create_roles_table.php
php artisan migrate --path=database/migrations/2025_03_06_232118_create_usuarios_table.php
php artisan migrate --path=database/migrations/2025_03_06_232146_create_pacientes_table.php
php artisan migrate --path=database/migrations/2025_03_06_232315_create_citas_table.php
php artisan migrate --path=database/migrations/2025_03_06_232352_create_doctores_table.php
php artisan migrate --path=database/migrations/2025_03_06_232506_create_especialidades_table.php
php artisan migrate --path=database/migrations/2025_03_06_232539_create_doctor_especialidad_table.php

 php artisan migrate
```
### 6. Iniciar el servidor local
```bash
 php artisan serve
```
La aplicación estará disponible en `http://127.0.0.1:8000`


## 🌟 Licencia
Este proyecto está bajo la licencia MIT. Puedes ver más detalles en el archivo `LICENSE`.

---
🚀 **MediTrack - Optimizando la gestión de la salud** 👩‍⚕️👨‍⚕️


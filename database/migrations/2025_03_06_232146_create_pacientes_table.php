<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            // COlumnas
            $table->string('nombre');
            $table->string('apellido') -> nullable();
            $table->string('edad');
            $table->string('genero');
            $table->string('telefono')->nullable();
            $table->enum('tipo_identificacion',['CC','CE','TI','RC','PA','MS','NIT'])->unique() -> default('CC');
            $table->string('identificacion') -> unique();
            $table->string('eps');
            $table->date('f_nacimiento');
            // Relaciones
            // Relacion (1-1) con Usuarios
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            // Relacion (1-N) con citas
            $table->foreignId('citas_id')->constrained('citas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};

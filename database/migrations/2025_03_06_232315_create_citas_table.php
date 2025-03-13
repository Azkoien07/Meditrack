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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            // Columnas
            $table->date('fecha');
            $table->time('hora');
            $table->string('sede');
            $table->enum('estado', ['Pendiente','Cancelada','Realizada']) -> default('Pendiente');
            // Relaciones
            // Relacion (N:1) con la tabla de Doctor
            $table->foreignId('doctor_id')->constrained('doctores')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};

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
        Schema::create('doctores', function (Blueprint $table) {
            $table->id();
            //Columnas
            $table->string('nombre');
            $table->string('apellido')->nullable();
            $table->enum('genero', ['masculino', 'femenino', 'otro']);
            $table->enum('turno', ['mañana', 'tarde', 'noche']);
            
            // Relación (1-1) con Usuario
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctores');
    }
};

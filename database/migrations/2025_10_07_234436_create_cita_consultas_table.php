<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('cita_consultas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            $table->foreignId('medico_id')->constrained('medicos')->onDelete('cascade');
            $table->foreignId('consultorio_id')->constrained('consultorios')->onDelete('cascade');
            $table->dateTime('fecha_hora');
            $table->string('estado')->default('pendiente');
            $table->text('motivo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('cita_consultas');
    }
};


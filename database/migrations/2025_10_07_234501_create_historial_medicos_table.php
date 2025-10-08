<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('historial_medicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            $table->text('descripcion');
            $table->date('fecha')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('historial_medicos');
    }
};


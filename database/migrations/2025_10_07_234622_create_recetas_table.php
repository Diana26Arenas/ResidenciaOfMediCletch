<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('recetas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            $table->foreignId('medico_id')->constrained('medicos')->onDelete('cascade');
            $table->text('descripcion')->nullable();
            $table->date('fecha');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('recetas');
    }
};


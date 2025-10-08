<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tratamientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cita_id')->constrained('cita_consultas')->onDelete('cascade');
            $table->foreignId('medicamento_id')->nullable()->constrained('medicamentos')->nullOnDelete();
            $table->string('dosis')->nullable();
            $table->string('duracion')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tratamientos');
    }
};


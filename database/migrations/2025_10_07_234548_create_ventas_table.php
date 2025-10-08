<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            $table->date('fecha');
            $table->decimal('total', 12, 2);
            $table->string('metodo_pago')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('ventas');
    }
};


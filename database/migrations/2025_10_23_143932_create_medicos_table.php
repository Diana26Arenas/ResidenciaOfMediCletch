<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medicos', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // <-- CORREGIDO: De 'nombre' a 'name'
            $table->string('specialty');
            $table->unsignedBigInteger('consultorio_id')->nullable();
            
            // AÑADIDO: user_id es necesario para vincular al médico a su cuenta de login
            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Eliminamos email y teléfono de la tabla 'medicos' porque ya están en la tabla 'users'
            // El campo email es la clave foránea user_id
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicos');
    }
};
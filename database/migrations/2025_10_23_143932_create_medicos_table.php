<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicosTable extends Migration
{
    public function up()
    {
        Schema::create('medicos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('especialidad')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('telefono')->nullable();
            $table->unsignedBigInteger('consultorio_id')->nullable();
            $table->foreign('consultorio_id')->references('id')->on('consultorios')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medicos');
    }
}

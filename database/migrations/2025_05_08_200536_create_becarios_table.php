<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('becarios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nombre');
            $table->string('cedula')->unique();
            $table->string('carrera')->nullable();
            $table->string('semestre')->nullable();
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->string('horario')->nullable();
            $table->float('meta_taller')->default(40)->nullable();
            $table->float('meta_chat')->default(15)->nullable();
            $table->float('meta_volin')->default(60)->nullable();
            $table->float('meta_volex')->default(40)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('becarios');
    }
};

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
            $table->string('apellido');
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
            $table->enum('nivel_cevaz', ['LEVEL 1', 'LEVEL 2', 'LEVEL 3', 'LEVEL 4', 'LEVEL 5', 'LEVEL 6', 'LEVEL 7', 'LEVEL 8', 'LEVEL 9', 'LEVEL 10', 'LEVEL 11', 'LEVEL 12', 'LEVEL 13', 'LEVEL 14', 'LEVEL 15', 'LEVEL 16', 'LEVEL 17', 'LEVEL 18', 'LEVEl 19'])->default('LEVEL 1')->nullable();


            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('becarios');
    }
};

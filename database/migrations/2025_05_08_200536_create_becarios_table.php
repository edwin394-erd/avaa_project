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
            $table->string('fotoperfil')->nullable();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('cedula')->unique();
            $table->string('carrera')->nullable();
            // $table->string('semestre')->nullable();
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->enum('genero', ['Masculino', 'Femenino']);
            $table->string('horario')->nullable();
            $table->float('meta_taller')->default(40)->nullable();
            $table->float('meta_chat')->default(15)->nullable();
            $table->float('meta_volin')->default(60)->nullable();
            $table->float('meta_volex')->default(40)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->unsignedBigInteger('user_id')->unique();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            // $table->enum('tipouni'), ['Publica', 'Privada'])->default('Privada');
            // $table->date('fechainiciouni')->nullable();
            // $table->string('Mencion')->nullable();
            // $table->string('area_estudio')->nullable();
            // $table->string('escala_evaluacion')->nullable();
            // $table->string('regimen_estudio')->nullable();
            // $table->boolean('poseebeca')->default(false);
            // $table->string('comprobanteinscripcion')->nullable();
            // $table->string('horarioclases')->nullable();




            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('becarios');
    }
};

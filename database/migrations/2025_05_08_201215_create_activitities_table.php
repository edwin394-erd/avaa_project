<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activitities', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('description');
            $table->integer('duration');
            $table->string('location');
            $table->enum('actividad', ['volin','volex','chat','taller']);
            $table->date('date');
            $table->time('hora_inicio');
            $table->date('fecha');
            $table->enum('status', ['pendiente', 'completada', 'cancelada'])->default('pendiente');
            $table->integer('quorum_minimo')->default(0);
            $table->integer('quorum_maximo')->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activitities');
    }
};

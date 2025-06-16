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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('facilitador')->nullable();
            $table->integer('duration')->nulleable();
            $table->string('location')->nullable();
            $table->enum('actividad', ['volin','volex','chat','taller']);
            $table->time('hora_inicio');
            $table->date('fecha');
            $table->enum('status', ['pendiente', 'completada', 'cancelada'])->default('pendiente');
            $table->integer('quorum_minimo')->default(0);
            $table->integer('quorum_maximo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};

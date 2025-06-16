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
        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('becario_id')->constrained()->onDelete('cascade');
            $table->string('titulo');
            $table->enum('actividad', ['chat', 'taller', 'volin', 'volex']);
            $table->enum('modalidad', ['online', 'presencial']);
            $table->float('duracion');
            $table->string('facilitador')->nullable();
            $table->date('fecha');
            $table->enum('estado', ['pendiente', 'aprobado', 'rechazado'])->default('pendiente');
            $table->string('observacion')->nullable();
            $table->enum('anulado', ['SI','NO'])->default('NO');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stats');
    }
};

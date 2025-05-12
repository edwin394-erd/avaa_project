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
            $table->string('name'); // Nombre del becario
            $table->string('description'); // Nombre del becario
            $table->integer('duration'); // Relación con la tabla `becarios`
            $table->string('location'); // Relación con la tabla `becarios`
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

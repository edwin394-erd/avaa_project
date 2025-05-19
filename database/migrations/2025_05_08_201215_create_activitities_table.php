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
            $table->date('date'); 
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

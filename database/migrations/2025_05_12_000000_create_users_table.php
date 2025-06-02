<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('becario_id')->unique()->nullable();
            $table->unsignedBigInteger('personal_id')->unique()->nullable();
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('activo')->default('1');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('becario_id')
                ->references('id')
                ->on('becarios')
                ->onDelete('cascade');
        });

        // Agrega el CHECK constraint manualmente (solo si tu motor lo soporta)
        DB::statement("ALTER TABLE users ADD CONSTRAINT users_becario_personal_check CHECK (
            (becario_id IS NOT NULL AND personal_id IS NULL) OR
            (becario_id IS NULL AND personal_id IS NOT NULL)
        )");
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};

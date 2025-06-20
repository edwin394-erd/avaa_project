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
            $table->string('fotoperfil')->nullable();
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('activo')->default('1');
            $table->rememberToken();
            $table->timestamps();
        });

        // Insertar usuario admin por defecto (asumiendo que el personal con id=1 existe)
        \DB::table('users')->insert([
        'role'        => 'admin',
        'email'       => 'admin@gmail.com',
        'password'    => bcrypt('123456'), // Cambia la contraseña si lo deseas
        'activo'      => '1',
        'created_at'  => now(),
        'updated_at'  => now(),
    ]);
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};

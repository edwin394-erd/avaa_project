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
        Schema::create('personals', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('cedula')->unique();
            $table->string('correo')->unique();
            $table->string('telefono')->nullable();
            $table->enum('genero', ['Masculino', 'Femenino']);
            $table->string('direccion')->nullable();
            $table->string('cargo')->nullable();
            $table->timestamps();
            $table->date('fecha_nacimiento')->nullable();
        });

         // Insertar un registro por defecto
        \DB::table('personals')->insert([
            'nombre' => 'Admin',
            'apellido' => 'Principal',
            'cedula' => '00000000',
            'genero' => 'Femenino',
            'correo' => 'admin@gmail.com',
            'telefono' => null,
            'direccion' => null,
            'cargo' => 'Administrador',
            'created_at' => now(),
            'updated_at' => now(),
            'fecha_nacimiento' => null,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personals');
    }
};

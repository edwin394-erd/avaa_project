<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'fotoperfil',
        'nombre',
        'apellido',
        'correo',
        'fecha_nacimiento',
        'cedula',
        'genero',
        'cargo',
        'telefono',
        'direccion',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

     

}

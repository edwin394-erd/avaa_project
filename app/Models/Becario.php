<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Becario extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nombre',
        'apellido',
        'cedula',
        'carrera',
        'genero',
        'telefono',
        'direccion',
        'horario',
        'meta_taller',
        'meta_chat',
        'meta_volin',
        'meta_volex',
        'fecha_nacimiento',
    ];
    protected $casts = [
        'meta_taller' => 'float',
        'meta_chat' => 'float',
        'meta_volin' => 'float',
        'meta_volex' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

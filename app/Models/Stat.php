<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'actividad',
        'modalidad',
        'duracion',
        'fecha',
        'user_id',
    ];
}

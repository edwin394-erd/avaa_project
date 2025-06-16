<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
       protected $fillable = [
        'name',
        'facilitador',
        'duration',
        'location',
        'actividad',
        'hora_inicio',
        'fecha',
        'status',
        'quorum_minimo',
        'quorum_maximo'
    ];
}

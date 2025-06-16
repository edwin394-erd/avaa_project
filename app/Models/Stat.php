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
        'becario_id',
        'estado',
        'observacion',
        'anulado',
    ];

    public function evidencias()
    {
        return $this->hasMany(Evidencia::class, 'stats_id');
    }
    public function becario()
    {
        return $this->belongsTo(Becario::class);
    }
}

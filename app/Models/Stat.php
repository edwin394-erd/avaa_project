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
        'estado',
        'observacion',
        'anulado',
    ];

    public function evidencias()
    {
        return $this->hasMany(Evidencia::class, 'stats_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

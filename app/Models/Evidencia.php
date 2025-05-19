<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidencia extends Model
{
    protected $fillable = ['stats_id', 'ruta_imagen'];

    public function estadistica()
    {
        return $this->belongsTo(Estadistica::class);
    }
}
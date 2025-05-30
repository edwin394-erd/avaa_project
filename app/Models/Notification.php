<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'titulo',
        'mensaje',
        'leida',
        'stat_id',
    ];

    // Relación con el usuario destinatario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

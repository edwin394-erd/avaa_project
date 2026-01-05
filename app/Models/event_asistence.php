<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event_asistence extends Model
{
    use HasFactory;
    protected $table = 'events_asistances';
    protected $fillable = [
        'becario_id',
        'event_id',
    ];


    public function becario()
    {
        return $this->belongsTo(Becario::class, 'becario_id');
    }
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}

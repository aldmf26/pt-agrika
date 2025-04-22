<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendadanJadwalTinjauanManajemen extends Model
{
    protected $fillable = [
        'dari_jam',
        'sampai_jam',
        'agenda',
        'pic',
        'tanggal',

    ];
}

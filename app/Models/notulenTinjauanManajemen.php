<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class notulenTinjauanManajemen extends Model
{
    protected $fillable = [
        'agenda',
        'hasil_pembahasan',
        'action_plan',
        'pic',
        'duedate',
        'status',
        'tanggal',

    ];
}

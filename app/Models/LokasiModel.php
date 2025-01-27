<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LokasiModel extends Model
{
    protected $table = 'lokasi';

    protected $fillable = ['lokasi', 'lantai', 'created_at', 'updated_at'];
}

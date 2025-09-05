<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecallProduct extends Model
{
    protected $guarded = [];

    public function getNamaPelangganAttribute($value)
    {
        return ucwords($value);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RumahWalet extends Model
{
    protected $table = 'rumah_walet';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function getAlamatAttribute($value)
    {
        return ucwords(strtolower($value));
    }
    
}

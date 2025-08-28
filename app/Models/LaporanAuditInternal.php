<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanAuditInternal extends Model
{
    protected $guarded = [];

    public function getDivisiAttribute($value)
    {
        return strtoupper($value);
    }

    public function getStatusAttribute($value)
    {
        return ucwords($value);
    }
    public function getTindakanAttribute($value)
    {
        return $value;
    }
}

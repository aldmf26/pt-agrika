<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramAuditInternal extends Model
{
    protected $guarded = [];

    public function getDepartemenAttribute($value)
    {
        return strtoupper($value);
    }
    public function getAuditeAttribute($value)
    {
        return ucwords($value);
    }
    public function getAuditorAttribute($value)
    {
        return ucwords($value);
    }
}

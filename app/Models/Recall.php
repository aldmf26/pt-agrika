<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recall extends Model
{
    protected $table = 'recalls';
    protected $guarded = [];
    protected $primaryKey = 'id';

    public function teamMembers()
    {
        return $this->hasMany(RecallTeamMember::class, 'recall_id');
    }

    public function products()
    {
        return $this->hasMany(RecallProduct::class, 'recall_id');
    }
}

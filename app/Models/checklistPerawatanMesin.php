<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class checklistPerawatanMesin extends Model
{
    protected $guarded = [];


    public function perawatan()
    {
        return $this->belongsTo(ProgramPerawatanMesin::class, 'perawatan_mesin_id', 'id');
    }
}

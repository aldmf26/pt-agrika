<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SbwKotorModel extends Model
{
    protected $table = 'sbw_kotor';
    protected $guarded = [];


    public function grade()
    {
        return $this->belongsTo(GradeSbwModel::class, 'grade_id');
    }
}

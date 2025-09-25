<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RespondenSurvey extends Model
{
    protected $table = 'responden_survey';
    protected $guarded = ['id'];

    public function jawaban()
    {
        return $this->hasMany(JawabanSurvey::class);
    }
}

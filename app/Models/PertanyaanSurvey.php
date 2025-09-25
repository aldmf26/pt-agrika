<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PertanyaanSurvey extends Model
{
    protected $table = 'pertanyaan_survey';
    protected $guarded = ['id'];

    public function jawaban()
    {
        return $this->hasMany(JawabanSurvey::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanSurvey extends Model
{
    protected $table = 'jawaban_survey';
    protected $guarded = ['id'];

    public function responden()
    {
        return $this->belongsTo(RespondenSurvey::class, 'responden_id');
    }

    public function pertanyaan()
    {
        return $this->belongsTo(PertanyaanSurvey::class, 'pertanyaan_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaianParameter extends Model
{
    protected $table = 'hrga2_penilaian_parameter';
    protected $guarded = [];

    public function penilaian()
    {
        return $this->belongsTo(SumPenilaianKompetensi::class, 'penilaian_id');
    }
}

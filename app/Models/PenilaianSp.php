<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaianSp extends Model
{
    protected $table = 'hrga2_sp';
    protected $guarded = [];

    public function penilaian()
    {
        return $this->belongsTo(SumPenilaianKompetensi::class, 'penilaian_id');
    }
}

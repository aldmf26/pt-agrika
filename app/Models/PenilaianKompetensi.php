<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;

class PenilaianKompetensi extends Model
{
    protected $table = 'hrga2_penilaian_kompetensi';
    protected $guarded = [];

    public function penilaian()
    {
        return $this->belongsTo(SumPenilaianKompetensi::class, 'penilaian_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatatanKehadiran extends Model
{
    protected $table = 'hrga2_catatan_kehadiran';
    protected $guarded = [];

    public function penilaian()
    {
        return $this->belongsTo(SumPenilaianKompetensi::class, 'penilaian_id');
    }
}

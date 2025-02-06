<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalGapAnalysis extends Model
{

    protected $fillable = [
        'divisi_id',
        'bulan_rencana',
        'tahun_rencana',
        'tgl_dari',
        'tgl_sampai',
    ];
    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }
}

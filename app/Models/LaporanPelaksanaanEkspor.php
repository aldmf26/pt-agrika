<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanPelaksanaanEkspor extends Model
{
    protected $fillable = [
        'nama',
        'tanggal',
        'uraian_barang',
        'nomor_pos',
        'volume',
        'nilai',

    ];
}

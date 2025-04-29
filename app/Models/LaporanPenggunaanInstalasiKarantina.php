<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanPenggunaanInstalasiKarantina extends Model
{
    protected $fillable = [
        'nota',
        'tgl',
        'jenis_media_pembawa',
        'jumlah',
        'negara_asal',
        'negara_tujuan',
        'tgl_pengeluaran',
        'petugas_karantina_hewan',
        'kejadian',
        'keterangan'
    ];
}

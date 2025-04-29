<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeaderLaporanPenggunaanInstalasi extends Model
{
    protected $fillable = [
        'nota',
        'nama_pemilik',
        'no_sk',
        'masa_berlaku',
        'jenis_media_pembawa',
        'negara_asal',
        'kapasitas',
        'perusahaan',
        'alamat',
        'no_telp',

    ];
}

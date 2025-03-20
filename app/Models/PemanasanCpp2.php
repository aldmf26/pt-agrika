<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemanasanCpp2 extends Model
{
    protected $fillable = [
        'tanggal',
        'tray',
        'kode_batch',
        'jenis',
        'pcs',
        'gr',
        'tventing_c',
        'tventing_mnt',
        'ttot_c',
        'ttot_mnt',
        'keterangan',
    ];
}

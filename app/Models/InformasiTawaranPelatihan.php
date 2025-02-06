<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiTawaranPelatihan extends Model
{
    protected $table = 'informasi_tawaran_pelatihan';
    protected $fillable = [
        'tanggal',
        'jenis',
        'sasaran',
        'tema',
        'sumber_informasi',
        'personil_penghubung',
        'no_telp',
        'email',
    ];
}

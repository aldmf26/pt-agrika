<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenimbanganHasilProduksi extends Model
{
    protected $fillable = [
        'tanggal',
        'jenis_produk',
        'kode_batch',
        'pcs',
        'gr',
        'box',
        'keterangan',
    ];
}

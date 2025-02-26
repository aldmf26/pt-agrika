<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuktiPermintaanPengeluaranBarang extends Model
{
    protected $table = 'bukti_permintaan_pengeluaran_barangs';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}

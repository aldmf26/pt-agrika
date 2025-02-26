<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuktiPenerimaanBarang extends Model
{
    protected $table = 'bukti_penerimaan_barang';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}

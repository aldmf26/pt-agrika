<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function kode_bahan_baku()
    {
        return $this->belongsTo(KodeBahanBaku::class, 'kode_barang', 'kode');
    }

    public function penerimaan()
    {
        return $this->hasMany(PenerimaanHeader::class, 'id_barang');
    }

    public function penerimaanKemasan()
    {
        return $this->hasMany(PenerimaanKemasanHeader::class, 'id_barang');
    }
}

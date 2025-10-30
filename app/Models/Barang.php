<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function getNamaBarangAttribute($value)
    {
        return ucfirst($value);
    }

    public function getSatuanAttribute($value)
    {
        return strtoupper($value);
    }

    public function getKategoriAttribute($value)
    {
        return ucfirst($value);
    }

    public function supplier()
    {
        return $this->belongsTo(Suplier::class, 'supplier_id');
    }

    public function kode_bahan_baku()
    {
        return $this->belongsTo(KodeBahanBaku::class, 'kode_barang', 'id');
    }

    public function penerimaan()
    {
        return $this->hasMany(PenerimaanHeader::class, 'id_barang');
    }


    public function penerimaanKemasan()
    {
        return $this->hasMany(PenerimaanKemasanHeader::class, 'id_barang');
    }

    public function pengeluaran()
    {
        return $this->hasMany(BuktiPermintaanPengeluaranBarang::class, 'id_barang');
    }

    public function purchaseRequestItem()
    {
        return $this->hasMany(PurchaseRequestItem::class, 'item_spesifikasi', 'nama_barang');
    }
}

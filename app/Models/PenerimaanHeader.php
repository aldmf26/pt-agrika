<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenerimaanHeader extends Model
{
    protected $table = 'penerimaan_header';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function getNoKendaraanAttribute($value)
    {
        return ucfirst($value);
    }

    public function getPengemudiAttribute($value)
    {
        return ucfirst($value);
    }

    public function getJumlahBarangAttribute($value)
    {
        return ucfirst($value);
    }

    public function getStatusPenerimaanAttribute($value)
    {
        return ucfirst($value);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function supplier()
    {
        return $this->belongsTo(Suplier::class, 'supplier_id');
    }

    public function kriteria()
    {
        return $this->hasMany(PenerimaanKriteria::class, 'id_penerimaan');
    }
}

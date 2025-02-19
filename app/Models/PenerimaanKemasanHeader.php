<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenerimaanKemasanHeader extends Model
{
    protected $table = 'penerimaan_kemasan_header';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function supplier()
    {
        return $this->belongsTo(Suplier::class, 'id_supplier');
    }

    public function kriteria()
    {
        return $this->hasMany(PenerimaanKemasanKriteria::class, 'id_penerimaan');
    }
}

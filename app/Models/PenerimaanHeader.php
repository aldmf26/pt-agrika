<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenerimaanHeader extends Model
{
    protected $table = 'penerimaan_header';
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
        return $this->hasMany(PenerimaanKriteria::class, 'id_penerimaan');
    }
}

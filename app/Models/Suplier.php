<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function getNamaSupplierAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    public function getKategoriAttribute($value)
    {
        return ucfirst($value);
    }
    public function getProdusenAttribute($value)
    {
        return ucfirst($value);
    }
    public function getContactPersonAttribute($value)
    {
        return ucfirst($value);
    }
    public function getKetAttribute($value)
    {
        return ucfirst($value);
    }


    public function barang()
    {
        return $this->hasMany(Barang::class, 'supplier_id');
    }

    public function penerimaan()
    {
        return $this->hasMany(PenerimaanHeader::class, 'id_supplier');
    }


    public function evaluasi()
    {
        return $this->hasMany(Evaluasi::class, 'supplier_id');
    }
}

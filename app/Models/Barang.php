<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function penerimaan()
    {
        return $this->hasMany(PenerimaanHeader::class, 'id_barang');
    }

    public function penerimaanKemasan()
    {
        return $this->hasMany(PenerimaanKemasanHeader::class, 'id_barang');
    }
}

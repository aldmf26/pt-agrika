<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenangananProdukTidakSesuai extends Model
{
    protected $table = 'penanganan_produk_tidak_sesuai';
    protected $guarded = [];
    protected $primaryKey = 'id';

    public function getSumberPenyebabAttribute($value)
    {
        return ucfirst($value);
    }

    public function getNamaProdukAttribute($value)
    {
        return ucwords($value);
    }

    public function getKodeProduksiAttribute($value)
    {
        return ucwords($value);
    }

    public function getJumlahProdukAttribute($value)
    {
        return number_format($value, 0);
    }

    public function getStatusAttribute($value)
    {
        return ucwords($value);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d', strtotime($value));
    }
}

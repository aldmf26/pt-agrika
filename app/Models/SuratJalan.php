<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratJalan extends Model
{
    protected $table = 'surat_jalan';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }
    public function detailSuratJalan()
    {
        return $this->hasMany(DetailSuratJalan::class, 'id_surat_jalan');
    }

    public function totalProduk()
    {
        return $this->detailSuratJalan()->sum('jumlah');
    }
}

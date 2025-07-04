<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenerimaanKemasanSbwKotorHeader extends Model
{
    protected $table = 'penerimaan_kemasan_sbw_kotor_header';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function getPengemudiAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    public function getJenisAttribute($value)
    {
        return ucfirst($value);
    }

    public function getAlamatRumahWaletAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    public function rumahWalet()
    {
        return $this->belongsTo(RumahWalet::class, 'noreg_rumah_walet', 'no_reg');
    }


    public function kriteria()
    {
        return $this->hasMany(PenerimaanKemasanSbwKotorKriteria::class, 'id_penerimaan');
    }
}

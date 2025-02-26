<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenerimaanKemasanSbwKotorHeader extends Model
{
    protected $table = 'penerimaan_kemasan_sbw_kotor_header';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function kriteria()
    {
        return $this->hasMany(PenerimaanKemasanSbwKotorKriteria::class, 'id_penerimaan');
    }
}

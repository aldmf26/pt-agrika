<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenerimaanKemasanKriteria extends Model
{
    protected $table = 'penerimaan_kemasan_kriteria';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public function header()
    {
        return $this->belongsTo(PenerimaanKemasanHeader::class, 'id_penerimaan');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenerimaanKriteria extends Model
{
    protected $table = 'penerimaan_kriteria';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public function header()
    {
        return $this->belongsTo(PenerimaanHeader::class, 'id_penerimaan');
    }
}

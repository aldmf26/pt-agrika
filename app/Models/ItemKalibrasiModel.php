<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemKalibrasiModel extends Model
{
    protected $table = 'itemkalibrasi';

    public function item_kalibrasi()
    {
        return $this->belongsTo(LokasiModel::class, 'lokasi_id', 'id');
    }
}

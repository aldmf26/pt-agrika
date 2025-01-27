<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPerawatan extends Model
{
    protected $table = 'item_perawatan';

    protected $fillable = [
        'lokasi_id',
        'nama_item',
        'merek',
        'no_identifikasi',
    ];

    public function lokasi()
    {
        return $this->belongsTo(LokasiModel::class, 'lokasi_id');
    }
}

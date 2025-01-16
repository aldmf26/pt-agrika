<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class hrga9_1KalibrasiModel extends Model
{
    protected $table = 'hrga9_1kalibrasi';

    protected $fillable = [
        'item_kalibrasi_id',
        'frekuensi',
        'minimum',
        'maksimum',
        'resolusi',
        'bulan',
        'tahun',
        'status',
    ];

    public function item_kalibrasi()
    {
        return $this->belongsTo(ItemKalibrasiModel::class, 'item_kalibrasi_id', 'id');
    }
}

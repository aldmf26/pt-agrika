<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalKalibrasi extends Model
{
    protected $table = 'jadwal_kalibrasi';
    protected $fillable = [
        'item_kalibrasi_id',
        'frekuensi',
        'rentang',
        'resolusi',
        'tanggal',
        'standar_nilai',
        'aktual_nilai',
        'status',
        'tanggal_selanjutnya',
    ];

    public function itemKalibrasi()
    {
        return $this->belongsTo(ItemKalibrasiModel::class, 'item_kalibrasi_id');
    }
}

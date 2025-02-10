<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemMesin extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mesin',
        'merek',
        'lokasi_id',
        'no_identifikasi',
    ];

    public function lokasi()
    {
        return $this->belongsTo(LokasiModel::class, 'lokasi_id');
    }
}

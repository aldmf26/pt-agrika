<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermintaanPerbaikanMesin extends Model
{
    protected $fillable = [
        'item_mesins_id',
        'invoice_pengajuan',
        'diajukan_oleh',
        'tanggal',
        'deadline',
        'waktu',
        'deskripsi_masalah',
    ];

    public function item_mesin()
    {
        return $this->belongsTo(ItemMesin::class, 'item_mesins_id');
    }
}

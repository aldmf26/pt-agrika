<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermintaanPerbaikanSaranaPrasana extends Model
{
    protected $table = 'permintaan_perbaikan_sarana_prasana';
    protected $fillable = [
        'item_id',
        'invoice_pengajuan',
        'diajukan_oleh',
        'tanggal',
        'waktu',
        'deskripsi_masalah',
    ];

    public function item()
    {
        return $this->belongsTo(ItemPerawatan::class, 'item_id');
    }
}

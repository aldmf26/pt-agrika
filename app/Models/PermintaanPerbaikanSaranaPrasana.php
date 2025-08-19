<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermintaanPerbaikanSaranaPrasana extends Model
{
    protected $table = 'permintaan_perbaikan_sarana_prasana';
    protected $fillable = [
        'item_id',
        'rincian_id',
        'invoice_pengajuan',
        'diajukan_oleh',
        'tanggal',
        'waktu',
        'deskripsi_masalah',
        'detail_perbaikan',
        'verifikasi_user',
    ];

    public function item()
    {
        return $this->belongsTo(ItemPerawatan::class, 'item_id');
    }
}

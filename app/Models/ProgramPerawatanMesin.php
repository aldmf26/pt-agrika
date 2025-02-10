<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramPerawatanMesin extends Model
{
    protected $fillable = ['item_mesin_id', 'frekuensi_perawatan', 'penanggung_jawab', 'tanggal_mulai'];
    public function item()
    {
        return $this->belongsTo(ItemMesin::class, 'item_mesin_id');
    }
}

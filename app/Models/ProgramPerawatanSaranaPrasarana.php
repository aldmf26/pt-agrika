<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramPerawatanSaranaPrasarana extends Model
{
    protected $table = 'program_perawatan_sarana_prasarana';
    protected $fillable = [
        'item_id',
        'frekuensi_perawatan',
        'penanggung_jawab',
        'tanggal_mulai',
    ];

    public function item()
    {
        return $this->belongsTo(ItemPerawatan::class, 'item_id');
    }
}

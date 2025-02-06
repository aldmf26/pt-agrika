<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerawatanModel extends Model
{
    protected $table = 'perawatan';
    protected $fillable = [
        'item_id',
        'tgl',
        'kesimpulan',
        'fungsi',
    ];

    public function item()
    {
        return $this->belongsTo(ItemPerawatan::class, 'item_id');
    }
}

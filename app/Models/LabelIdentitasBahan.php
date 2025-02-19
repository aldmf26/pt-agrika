<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabelIdentitasBahan extends Model
{
    protected $table = 'label_identitas_bahan_baku';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}

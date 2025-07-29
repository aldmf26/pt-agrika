<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilWawancara extends Model
{
    protected $guarded = [];

    public function pegawai()
    {
        return $this->belongsTo(DataPegawai::class, 'id_anak', 'id');
    }
}

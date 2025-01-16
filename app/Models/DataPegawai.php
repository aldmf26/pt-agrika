<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPegawai extends Model
{
    protected $guarded = [];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }
}

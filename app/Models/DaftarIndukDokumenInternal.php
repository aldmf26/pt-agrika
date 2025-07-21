<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarIndukDokumenInternal extends Model
{
    protected $table = 'daftar_induk_dokumen_internal';
    protected $fillable = [
        'no_dokumen',
        'divisi',
        'pic',
        'judul',
        'deskripsi',
        'tags'
    ];

    public function getDeskripsiAttribute($value)
    {
        return strtoupper($value);
    }

    public function setNoDokumenAttribute($value)
    {
        $this->attributes['no_dokumen'] = strtoupper($value);
    }

    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = strtoupper($value);
    }
}

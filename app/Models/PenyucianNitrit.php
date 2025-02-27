<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenyucianNitrit extends Model
{
    protected $guarded = [];
    protected $fillable = [
        'tanggal',
        'nama_operator',
        'start',
        'end',
        'waktu_penyucian',
        'pegawai_id',
        'no_box',
        'pcs',
        'gr',
        'ket',
    ];

    public function pegawai()
    {
        return $this->belongsTo(DataPegawai::class, 'pegawai_id', 'karyawan_id_dari_api');
    }
}

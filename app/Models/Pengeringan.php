<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeringan extends Model
{

    protected $fillable = [
        'pegawai_id',
        'no_box',
        'grade',
        'pcs',
        'gr',
        'pcs_akhir',
        'gr_akhir',
        'hcr',
        'ket',
        'tanggal',
        'pengawas'

    ];
    public function pegawai()
    {
        return $this->belongsTo(DataPegawai::class, 'pegawai_id', 'karyawan_id_dari_api');
    }
}

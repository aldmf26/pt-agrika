<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalMedicalModel extends Model
{
    protected $table = 'jadwal_medical';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_karyawan',
        'bulan',
        'tahun',
    ];

    public function data_pegawai()
    {
        return $this->belongsTo(DataPegawai::class, 'id_karyawan', 'karyawan_id_dari_api');
    }
}

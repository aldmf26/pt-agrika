<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class usulanDanIdentifikasi extends Model
{
    public function data_pegawai()
    {
        return $this->belongsTo(DataPegawai::class, 'data_pegawais_id', 'karyawan_id_dari_api');
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
    public function pelatihan()
    {
        return $this->belongsTo(ProgramPelatihanTahunan::class, 'nota_pelatihan', 'nota_pelatihan');
    }
}

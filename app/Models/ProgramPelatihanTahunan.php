<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramPelatihanTahunan extends Model
{
    protected $table = 'program_pelatihan_tahunans';
    protected $fillable = [
        'materi_pelatihan',
        'sumber',
        'narasumber',
        'sasaran_peserta',
        'tgl_rencana',
        'tgl_realisasi',
        'isi_usulan',
    ];
}

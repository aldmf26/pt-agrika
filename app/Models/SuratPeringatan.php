<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratPeringatan extends Model
{
    protected $table = 'hrga2_surat_peringatan';
    protected $guarded = [];

    public function penilaian()
    {
        return $this->belongsTo(SumPenilaianKompetensi::class, 'penilaian_id');
    }

    public function hitungTotalSP()
    {
        $total = ($this->sp_1 * 10) + ($this->sp_2 * 20) + ($this->sp_3 * 40);
        $this->update(['total_sp' => $total]);
        return $total;
    }
}

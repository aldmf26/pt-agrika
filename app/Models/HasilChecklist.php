<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilChecklist extends Model
{
    protected $table = 'ia_hasil_checklist';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class);
    }

    public function hasilChecklistByPeriode($bulan, $tahun)
    {
        return $this->hasMany(HasilChecklist::class, 'pertanyaan_id')
            ->whereYear('tanggal_audit', $tahun)
            ->whereMonth('tanggal_audit', $bulan);
    }
}

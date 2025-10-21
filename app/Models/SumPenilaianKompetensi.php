<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SumPenilaianKompetensi extends Model
{
    protected $table = 'hrga2_sum_penilaian_kompetensi';

    protected $guarded = [];

    // Relationships
    public function karyawan()
    {
        return $this->belongsTo(DataPegawai::class, 'karyawan_id', 'karyawan_id_dari_api');
    }

    public function kompetensi()
    {
        return $this->hasMany(PenilaianKompetensi::class, 'penilaian_id');
    }

    public function kehadiran()
    {
        return $this->hasMany(CatatanKehadiran::class, 'penilaian_id');
    }

    public function parameter()
    {
        return $this->hasMany(PenilaianParameter::class, 'penilaian_id');
    }

    public function suratPeringatan()
    {
        return $this->hasOne(PenilaianSp::class, 'penilaian_id');
    }

    // Helper Methods
    public function hitungTotalNilai()
    {
        $totalParameter = $this->parameter()->sum('nilai');
        $totalSP = $this->suratPeringatan ? $this->suratPeringatan->total_sp : 0;

        $nilaiAkhir = $totalParameter - $totalSP;

        $this->update(['total_nilai' => $nilaiAkhir]);

        return $nilaiAkhir;
    }

    public function getKategoriNilai()
    {
        $nilai = $this->total_nilai;

        if ($nilai >= 86 && $nilai <= 100) {
            return 'Baik Sekali';
        } elseif ($nilai >= 70 && $nilai <= 85) {
            return 'Baik';
        } elseif ($nilai >= 60 && $nilai <= 69) {
            return 'Cukup';
        } else {
            return 'Kurang';
        }
    }

    public function generateRekomendasi()
    {
        $kategori = $this->getKategoriNilai();

        $rekomendasi = [
            'Baik Sekali' => 'Ybs dinilai catap / baik dalam menjalankan performanya. Ybs bisa dilanjut kontrak / kerjasama dengan perusahaan.',
            'Baik' => 'Ybs dinilai catap / baik dalam menjalankan performanya. Ybs bisa dilanjut kontrak / kerjasama dengan perusahaan.',
            'Cukup' => 'Ybs dinilai catap / baik dalam menjalankan performanya. Ybs bisa dilanjut kontrak / kerjasama dengan perusahaan. Dipertimbangkan untuk mendapatkan kontrak yang panjang',
            'Kurang' => 'Performa kurang memuaskan. Perlu evaluasi lebih lanjut dan perbaikan.'
        ];

        return $rekomendasi[$kategori] ?? '';
    }

    public function getTotalKehadiranHari($bulan = null)
    {
        $query = $this->kehadiran();

        if ($bulan) {
            $query->where('bulan', $bulan);
        }

        return $query->sum('hari');
    }

    public function getTotalKehadiranJam($bulan = null)
    {
        $query = $this->kehadiran();

        if ($bulan) {
            $query->where('bulan', $bulan);
        }

        return $query->sum('jam');
    }
}

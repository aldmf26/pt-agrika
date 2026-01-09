<?php

namespace App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru;

use App\Http\Controllers\Controller;
use App\Models\DataPegawai;
use App\Services\DataPegawaiService;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hrga3HasilEvaluasiKaryawanBaru extends Controller
{
    public function index()
    {
        $bulan = dataDariBulan()['bulan'];
        $tahun = dataDariBulan()['tahun'];

        $datas = DataPegawai::with(['penilaianKaryawan'])
            ->whereRaw("year(tgl_masuk) = $tahun and month(tgl_masuk) >= $bulan")
            ->whereRaw("TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) >= 17")
            ->where('berhenti', 'T')
            ->orderBy('id', 'desc')
            ->get();

        $data = [
            'title' => 'Hrga 1.3 hasil evaluasi karyawan baru',
            'datas' => $datas
        ];
        return view('hrga.hrga1.hrga3_hasil_evaluasi_karyawan_baru.index', $data);
    }

    public function print(DataPegawai $pegawai)
    {

        $data = [
            'title' => 'HASIL EVALUASI KARYAWAN BARU',
            'dok' => 'Dok.No.: FRM.HRGA.01.04, Rev.00',
            'pegawai' => $pegawai
        ];
        return view('hrga.hrga1.hrga3_hasil_evaluasi_karyawan_baru.print', $data);
    }
}

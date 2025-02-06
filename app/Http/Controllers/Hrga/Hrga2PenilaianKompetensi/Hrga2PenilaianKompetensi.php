<?php

namespace App\Http\Controllers\Hrga\Hrga2PenilaianKompetensi;

use App\Http\Controllers\Controller;
use App\Models\DataPegawai;
use Illuminate\Http\Request;

class Hrga2PenilaianKompetensi extends Controller
{
    public function index()
    {
        $datas = DataPegawai::hasilEvaluasi();
        $data = [
            'title' => 'Hrga 2 penilaian kompetensi',
            'datas' => $datas

        ];
        return view('hrga.hrga2.hrga2_penilaian_kompetensi.index', $data);
    }

    public function penilaian($id)
    {
        $datas = DataPegawai::oneHasilEvaluasi($id);
        $data = [
            'title' => 'Penilaian Kompetensi',
            'karyawan' => $datas
        ];
        return view('hrga.hrga2.hrga2_penilaian_kompetensi.penilaian', $data);
    }

    public function print($id)
    {
        $datas = DataPegawai::oneHasilEvaluasi($id);
        $data = [
            'title' => 'LEMBAR PENILAIAN KOMPETENSI KARYAWAN',
            'dok' => 'Dok.No.: FRM.HRGA.02.02, Rev.00',
            'karyawan' => $datas
        ];
        return view('hrga.hrga2.hrga2_penilaian_kompetensi.print', $data);
    }
}

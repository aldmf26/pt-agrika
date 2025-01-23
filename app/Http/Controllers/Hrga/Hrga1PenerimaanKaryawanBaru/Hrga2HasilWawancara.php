<?php

namespace App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru;

use App\Http\Controllers\Controller;
use App\Models\DataPegawai;
use App\Services\DataPegawaiService;
use Illuminate\Http\Request;

class Hrga2HasilWawancara extends Controller
{
    public function index(DataPegawaiService $dataPegawaiService)
    {
        $dataPegawaiService->download();

        $datas = DataPegawai::with('divisi')->get();
        $data = [
            'title' => 'Hrga 1.2 hasil wawancara',
            'datas' => $datas
        ];
        return view('hrga.hrga1.hrga2_hasil_wawancara.index', $data);
    }

    public function print(Request $r)
    {
        $checkedValues = explode(',', $r->checked);
        $datas = DataPegawai::with('divisi')->whereIn('id', $checkedValues)->get();

        $data = [
            'title' => 'HASIL WAWANCARA KARYAWAN',
            'dok' => 'Dok.No.: FRM.HRGA.01.02, Rev.00',
            'datas' => $datas
        ];
        return view('hrga.hrga1.hrga2_hasil_wawancara.print',$data);
    }
}

<?php

namespace App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru;

use App\Http\Controllers\Controller;
use App\Models\PermohonanKaryawan;
use App\Services\DataPegawaiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hrga1PermohonanKaryawanController extends Controller
{

    public function index(DataPegawaiService $dataPegawaiService)
    {
        $dataPegawaiService->download();
        $datas = PermohonanKaryawan::dapatkan();

        $data = [
            'title' => 'Hrga 1.1 permohonan karyawan',
            'datas' => $datas
        ];
        return view('hrga.hrga1.hrga1_permohonan_karyawan.index', $data);
    }

    public function print($id)
    {
        $datas = PermohonanKaryawan::dapatkan($id);
        $data = [
            'title' => 'PERMOHONAN KARYAWAN BARU',
            'dok' => 'Dok.No.: FRM.HRGA.01.01, Rev.00',
            'datas' => $datas
        ];

        return view('hrga.hrga1.hrga1_permohonan_karyawan.print', $data);
    }
}

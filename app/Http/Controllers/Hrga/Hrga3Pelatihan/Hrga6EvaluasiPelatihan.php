<?php

namespace App\Http\Controllers\Hrga\Hrga3Pelatihan;

use App\Http\Controllers\Controller;
use App\Models\JadwalInformasiPelatihan;
use Illuminate\Http\Request;

class Hrga6EvaluasiPelatihan extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Evaluasi Pelatihan',
            'evaluasi' => JadwalInformasiPelatihan::all()
        ];
        return view('hrga.hrga3.hrga6evaluasipelatihan.index', $data);
    }

    public function print(Request $r)
    {
        $data = [
            'title' => 'Evaluasi Pelatihan',
            'evaluasi_detail' => JadwalInformasiPelatihan::where('id', $r->id_evaluasi)->first(),
        ];
        return view('hrga.hrga3.hrga6evaluasipelatihan.print', $data);
    }
}

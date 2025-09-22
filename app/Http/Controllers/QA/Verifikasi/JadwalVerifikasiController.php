<?php

namespace App\Http\Controllers\QA\Verifikasi;

use App\Http\Controllers\Controller;
use App\Models\JadwalVerifikasi;
use Illuminate\Http\Request;

class JadwalVerifikasiController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Jadwal Verifikasi',
        ];

        return view('qa.verifikasifalidasi.index', $data);
    }

    public function print(Request $r)
    {

        $data = [
            'title' => 'Jadwal Uji Lab',
            'tahun' => $r->tahun,
            'datas' => JadwalVerifikasi::where('tahun', $r->tahun)
                ->orderBy('item')
                ->get(),
        ];
        return view('qa.verifikasifalidasi.print', $data);
    }
}

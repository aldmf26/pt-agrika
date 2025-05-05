<?php

namespace App\Http\Controllers\Qc;

use App\Http\Controllers\Controller;
use App\Models\PerencanaanSwab;
use Illuminate\Http\Request;

class PerencanaanSwabController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Perencanaan Swab',
        ];
        return view('qc.perencanaan_swab.index', $data);
    }

    public function print(Request $r)
    {
        $data = [
            'title' => 'Perencanaan Swab',
            'datas' => PerencanaanSwab::where('tahun', $r->tahun)
                ->orderBy('jenis_kegiatan')
                ->get(),
            'tahun' => $r->tahun,
        ];
        return view('qc.perencanaan_swab.print', $data);
    }
}

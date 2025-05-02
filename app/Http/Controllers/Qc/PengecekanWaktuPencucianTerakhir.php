<?php

namespace App\Http\Controllers\Qc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PengecekanWaktuPencucianTerakhir extends Controller
{
    public function index(Request $r)
    {

        $bulan = empty($r->bulan) ? date('m') : $r->bulan;
        $tahun = empty($r->tahun) ? date('Y') : $r->tahun;

        $cabut = Http::get("https://sarang.ptagafood.com/api/apihasap/cabutbulan?bulan=$bulan?tahun=$tahun");
        $cabut = json_decode($cabut, TRUE);
        $data = [
            'title' => 'Pengecekan waktu pencucian terakhir',
            'cabut' => $cabut['data'],
            'bulan' => $bulan,
            'tahun' => $tahun,
            'bulanlist' => DB::table('bulan')->get(),
        ];
        return view('qc.pengecekan_waktu_pencucian_terakhir.index', $data);
    }
    public function print(Request $r)
    {
        $bulan = empty($r->bulan) ? date('m') : $r->bulan;
        $tahun = empty($r->tahun) ? date('Y') : $r->tahun;

        $cabut = Http::get("https://sarang.ptagafood.com/api/apihasap/cabutbulan?bulan=$bulan?tahun=$tahun");
        $cabut = json_decode($cabut, TRUE);
        $data = [
            'title' => 'Pengecekan waktu pencucian terakhir',
            'cabut' => $cabut['data'],
            'bulan' => $bulan,
            'tahun' => $tahun,
            'bulanlist' => DB::table('bulan')->get(),
        ];
        return view('qc.pengecekan_waktu_pencucian_terakhir.print', $data);
    }
}

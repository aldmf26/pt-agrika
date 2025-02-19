<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Pro2FormSerahTerimaBahanBaku extends Controller
{
    public function index(Request $r)
    {
        if (empty($r->bulan)) {
            $bulan = date('m');
            $tahun = date('Y');
        } else {
            $bulan = $r->bulan;
            $tahun = $r->tahun;
        }
        $bk = Http::get("https://sarang.ptagafood.com/api/apihasap/bk?bulan=$bulan&tahun=$tahun");
        $bk = json_decode($bk, TRUE);
        $data = [
            'title' => 'Form Serah Terima Bahan Baku Ke Pencabutan',
            'bk' => $bk['data'],
            'bulans' => DB::table('bulan')->get(),
            'bulan' => $bulan,
            'tahun' => $tahun

        ];
        return view('produksi.pro2formserahterimabahanbaku.index', $data);
    }

    public function print(Request $r)
    {
        $bk = Http::get("https://sarang.ptagafood.com/api/apihasap/bk?tgl1=$r->tgl1&tgl2=$r->tgl2");
        $bk = json_decode($bk, TRUE);
        $data = [
            'title' => 'Form Serah Terima Bahan Baku Ke Pencabutan',
            'bk' => $bk['data']
        ];
        return view('produksi.pro2formserahterimabahanbaku.print', $data);
    }
}

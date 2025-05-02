<?php

namespace App\Http\Controllers\QC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ProdukReleaseController extends Controller
{
    public function index(Request $r)
    {
        $bulan = empty($r->bulan) ? date('m') : $r->bulan;
        $tahun = empty($r->tahun) ? date('Y') : $r->tahun;

        $produk = Http::get("https://sarang.ptagafood.com/api/apihasap/produkrelease?bulan=$bulan?tahun=$tahun");
        $produk = json_decode($produk, TRUE);
        $data = [
            'title' => 'Produk Release',
            'produk_release' => $produk['data'],
            'bulan' => $bulan,
            'tahun' => $tahun,
            'bulanlist' => DB::table('bulan')->get(),
        ];
        return view('qc.produk_release.index', $data);
    }
    public function print(Request $r)
    {
        $bulan = empty($r->bulan) ? date('m') : $r->bulan;
        $tahun = empty($r->tahun) ? date('Y') : $r->tahun;

        $produk = Http::get("https://sarang.ptagafood.com/api/apihasap/produkrelease?bulan=$bulan?tahun=$tahun");
        $produk = json_decode($produk, TRUE);
        $data = [
            'title' => 'Produk Release',
            'produk_release' => $produk['data'],
            'bulan' => $bulan,
            'tahun' => $tahun,
            'bulanlist' => DB::table('bulan')->get(),
        ];
        return view('qc.produk_release.print', $data);
    }
}

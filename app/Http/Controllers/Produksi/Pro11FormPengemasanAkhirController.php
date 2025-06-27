<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Pro11FormPengemasanAkhirController extends Controller
{
    public function index(Request $r)
    {

        $pengiriman_akhir = Http::get("https://sarang.ptagafood.com/api/apihasap/pengiriman_akhir");
        $pengiriman_akhir = json_decode($pengiriman_akhir, TRUE);
        $data = [
            'title' => 'Form Pengemasan Akhir',
            'pengiriman_akhir' => $pengiriman_akhir['data'],

        ];
        return view('produksi.pro11_form_pengemasan_akhir.index', $data);
    }

    public function print(Request $r)
    {
        $tgl = $r->tgl;
        $pengiriman_akhir = Http::get("https://sarang.ptagafood.com/api/apihasap/pengiriman_akhir_detail?tgl=$tgl");
        $pengiriman_akhir = json_decode($pengiriman_akhir, TRUE);
        $data = [
            'title' => 'Form Pengemasan Akhir',
            'tgl' => $r->tgl,
            'pengiriman_akhir' => $pengiriman_akhir['data']
        ];
        return view('produksi.pro11_form_pengemasan_akhir.print', $data);
    }
}

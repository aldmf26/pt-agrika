<?php

namespace App\Http\Controllers\PPC\Gudang_FG;

use App\Http\Controllers\Controller;
use App\Models\KartuStok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FG4KartuStokController extends Controller
{
    public function index()
    {
        $kartu = Http::get("https://sarang.ptagafood.com/api/apihasap/stok_produk_jadi");
        $kartu = json_decode($kartu, TRUE);

        $data = [
            'title' => 'Kartu Stok',
            'kartu' => $kartu['data']
        ];
        return view('ppc.gudang_fg.kartu_stok.index', $data);
    }

    public function print(Request $r)
    {
        $kartu = Http::get("https://sarang.ptagafood.com/api/apihasap/stok_produk_jadi_detail?grade=$r->grade");
        $kartu = json_decode($kartu, TRUE);
        $data = [
            'title' => 'KARTU STOK PRODUK JADI',
            'dok' => 'Dok.No.: FRM.WHS.03.02, Rev.00',
            'kartu' => $kartu['data'],
            'grade' => $r->grade

        ];

        return view('ppc.gudang_fg.kartu_stok.print', $data);
    }
}

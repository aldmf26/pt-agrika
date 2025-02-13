<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Pro1PersiapandanPembersihanController extends Controller
{
    public function index()
    {
        $bk = Http::get("https://sarang.ptagafood.com/api/apihasap");
        $bk = json_decode($bk, TRUE);

        $data = [
            'title' => 'Persiapan dan Pembersihan',
            'bk' => $bk['data']
        ];
        return view('produksi.pro1persiapandanpembersihan.index', $data);
    }

    public function print(Request $r)
    {
        $detail = Http::get("https://sarang.ptagafood.com/api/apihasap/detail/" . $r->no_invoice);
        $detail = json_decode($detail, TRUE);

        $data = [
            'title' => 'Persiapan dan Pembersihan',
            'detail' => $detail['data'],
            'pengawas' => $r->pengawas,
            'tanggal' => $r->tgl
        ];
        return view('produksi.pro1persiapandanpembersihan.print', $data);
    }
}

<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Pro3FormPencabutanBulu extends Controller
{
    public function index(Request $r)
    {
        if (empty($r->tgl)) {
            $tgl = date('Y-m-d');
        } else {
            $tgl = $r->tgl;
        }
        $cabut = Http::get("https://sarang.ptagafood.com/api/apihasap/cabut?tgl=$tgl");
        $cabut = json_decode($cabut, TRUE);
        $data = [
            'title' => 'Form Pencabutan Bulu',
            'cabut' => $cabut['data'],
            'tgl' => $tgl
        ];

        return view('produksi.pro3formpencabutanbulu.index', $data);
    }

    public function print(Request $r)
    {
        $cabut = Http::get("https://sarang.ptagafood.com/api/apihasap/cabut?tgl=$r->tgl");
        $cabut = json_decode($cabut, TRUE);
        $data = [
            'title' => 'Form Pencabutan Bulu',
            'cabut' => $cabut['data'],
            'tgl' => $r->tgl
        ];

        return view('produksi.pro3formpencabutanbulu.print', $data);
    }
}

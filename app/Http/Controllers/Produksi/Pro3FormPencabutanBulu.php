<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Pro3FormPencabutanBulu extends Controller
{
    public function index(Request $r)
    {
        $posisi = auth()->user()->posisi_id;

        if ($posisi == 1) {
            $cabut = Http::get("https://sarang.ptagafood.com/api/apihasap/cabut");
            $cabut = json_decode($cabut, TRUE);
        } else {
            $id_pengawas = auth()->user()->id;

            $cabut = Http::get("https://sarang.ptagafood.com/api/apihasap/cabut?id_pengawas=$id_pengawas");
            $cabut = json_decode($cabut, TRUE);
        }


        $data = [
            'title' => 'Form Pencabutan Bulu',
            'cabut' => $cabut['data'],
        ];
        return view('produksi.pro3formpencabutanbulu.index', $data);
    }

    public function print(Request $r)
    {
        $cabut = Http::get("https://sarang.ptagafood.com/api/apihasap/cabut_detail?tgl=$r->tgl&id_pengawas=$r->id_pengawas");
        $cabut = json_decode($cabut, TRUE);
        $data = [
            'title' => 'Form Pencabutan Bulu',
            'cabut' => $cabut['data'],
            'tgl' => $r->tgl,
            'pengawas' => $r->pengawas
        ];

        return view('produksi.pro3formpencabutanbulu.print', $data);
    }
}

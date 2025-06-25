<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Pro6FormCetak extends Controller
{
    public function index(Request $r)
    {
        $posisi = auth()->user()->posisi_id;

        if ($posisi == 1) {
            $cetak = Http::get("https://sarang.ptagafood.com/api/apihasap/cetak");
            $cetak = json_decode($cetak, TRUE);
        } else {
            $id_pengawas = auth()->user()->id;

            $cetak = Http::get("https://sarang.ptagafood.com/api/apihasap/cetak?id_pengawas=$id_pengawas");
            $cetak = json_decode($cetak, TRUE);
        }



        $data = [
            'title' => 'Form Cetak',
            'cetak' => $cetak['data'],

        ];
        return view('produksi.pro6formcetak.index', $data);
    }

    public function print(Request $r)
    {
        $cetak = Http::get("https://sarang.ptagafood.com/api/apihasap/cetak_detail?tgl=$r->tgl&id_pengawas=$r->id_pengawas");
        $cetak = json_decode($cetak, TRUE);
        $data = [
            'title' => 'Form Cetak',
            'cetak' => $cetak['data'],
            'tgl' => $r->tgl,
            'pengawas' => $r->pengawas
        ];
        return view('produksi.pro6formcetak.print', $data);
    }
}

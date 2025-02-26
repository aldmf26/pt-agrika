<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Pro6FormCetak extends Controller
{
    public function index(Request $r)
    {
        if (empty($r->tgl)) {
            $tgl = date('Y-m-d');
        } else {
            $tgl = $r->tgl;
        }
        $cetak = Http::get("https://sarang.ptagafood.com/api/apihasap/cetak?tgl=$tgl");
        $cetak = json_decode($cetak, TRUE);
        $data = [
            'title' => 'Form Cetak',
            'cetak' => $cetak['data'],
            'tgl' =>  $tgl
        ];
        return view('produksi.pro6formcetak.index', $data);
    }

    public function print(Request $r)
    {
        $cetak = Http::get("https://sarang.ptagafood.com/api/apihasap/cetak?tgl=$r->tgl");
        $cetak = json_decode($cetak, TRUE);
        $data = [
            'title' => 'Form Cetak',
            'cetak' => $cetak['data'],
            'tgl' => $r->tgl
        ];
        return view('produksi.pro6formcetak.print', $data);
    }
}

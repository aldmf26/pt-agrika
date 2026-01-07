<?php

namespace App\Http\Controllers\PPC\Gudang_RM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RM5LabelIdentitasBahanController2 extends Controller
{
    public function index(Request $r)
    {
        $tgl1 = $r->tgl1 ?? date('2025-10-01');
        $tgl2 = $r->tgl2 ?? date('Y-m-d');

        $k = 'sbw';
        $bk = Http::get("https://sarang.ptagafood.com/api/apihasap/no_box_label?tgl1=$tgl1&tgl2=$tgl2");

        $bk = json_decode($bk, TRUE);

        $data = [
            'title' => 'Label Identitas Bahan Baku',
            'items' => $bk['data'],
            'k' => $k

        ];
        return view('ppc.gudang_rm.label_identitas_bahan2.index', $data);
    }
}

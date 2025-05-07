<?php

namespace App\Http\Controllers\Qc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KontrolPengemasanController extends Controller
{
    public function index(Request $r)
    {
        $tgl = $r->tgl ?? date('Y-m-d');
        $bk = Http::get("https://sarang.ptagafood.com/api/apihasap/kontrolPengemasan?tgl=" . $tgl);
        $bk = json_decode($bk, TRUE);
        $data = [
            'title' => 'Kontrol Pengemasan',
            'bk' => $bk['data'],
            'tgl' => $tgl,
        ];
        return view('qc.kontrol_pengemasan.index', $data);
    }

    public function print(Request $r)
    {
        $tgl = $r->tgl ?? date('Y-m-d');
        $bk = Http::get("https://sarang.ptagafood.com/api/apihasap/kontrolPengemasan?tgl=" . $tgl);
        $bk = json_decode($bk, TRUE);
        $data = [
            'title' => 'Kontrol Pengemasan',
            'bk' => $bk['data'],
            'tgl' => $tgl,
        ];
        return view('qc.kontrol_pengemasan.print', $data);
    }
}

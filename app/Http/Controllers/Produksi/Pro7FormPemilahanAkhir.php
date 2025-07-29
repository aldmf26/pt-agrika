<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Pro7FormPemilahanAkhir extends Controller
{
    public function index(Request $r)
    {

        $grading = Http::get("https://sarang.ptagafood.com/api/apihasap/grading");
        $grading = json_decode($grading, TRUE);


        $data = [
            'title' => 'Form pemilahan akhir',
            'grading' => $grading['data'],

        ];
        return view('produksi.pro7formpemilahanakhir.index', $data);
    }

    public function print(Request $r)
    {
        $grading = Http::get("https://sarang.ptagafood.com/api/apihasap/grading_detail?no_invoice=$r->no_po");
        $grading = json_decode($grading, TRUE);

        $data = [
            'title' => 'Form pemilahan akhir',
            'grading' => $grading['data'],
            'tgl' => $r->tgl,
            'kode_lot' => $r->kode_lot,
            'grade' => $r->grade,
        ];
        return view('produksi.pro7formpemilahanakhir.print', $data);
    }
}

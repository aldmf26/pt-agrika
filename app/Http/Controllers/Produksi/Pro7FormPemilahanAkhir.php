<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Pro7FormPemilahanAkhir extends Controller
{
    public function index(Request $r)
    {
        if (empty($r->tgl)) {
            $tgl = date('Y-m-d');
        } else {
            $tgl = $r->tgl;
        }
        $grading = Http::get("https://sarang.ptagafood.com/api/apihasap/grading?tgl=$tgl");
        $grading = json_decode($grading, TRUE);
        $data = [
            'title' => 'Form pemilahan akhir',
            'grading' => $grading['data'],
            'tgl' => $tgl
        ];
        return view('produksi.pro7formpemilahanakhir.index', $data);
    }

    public function print(Request $r)
    {
        $grading = Http::get("https://sarang.ptagafood.com/api/apihasap/grading?tgl=$r->tgl");
        $grading = json_decode($grading, TRUE);
        $data = [
            'title' => 'Form pemilahan akhir',
            'grading' => $grading['data'],
            'tgl' => $r->tgl
        ];
        return view('produksi.pro7formpemilahanakhir.print', $data);
    }
}

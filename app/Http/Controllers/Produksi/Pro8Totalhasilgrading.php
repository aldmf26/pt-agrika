<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Pro8Totalhasilgrading extends Controller
{
    public function index(Request $r)
    {
        $grading = Http::get("https://sarang.ptagafood.com/api/apihasap/ttlgrading");
        $grading = json_decode($grading, TRUE);
        $data = [
            'title' => 'Total hasil pemilahan akhir',
            'grading' => $grading['data'],

        ];
        return view('produksi.pro8totalgrading.index', $data);
    }

    public function print(Request $r)
    {
        $grading = Http::get("https://sarang.ptagafood.com/api/apihasap/ttlgrading_detail?tgl=$r->tgl");
        $grading = json_decode($grading, TRUE);
        $data = [
            'title' => 'Form pemilahan akhir',
            'grading' => $grading['data'],
            'tgl' => $r->tgl,

        ];
        return view('produksi.pro8totalgrading.print', $data);
    }
}

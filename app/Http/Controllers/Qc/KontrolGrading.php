<?php

namespace App\Http\Controllers\Qc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KontrolGrading extends Controller
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
            'title' => 'Kontrol grading',
            'grading' => $grading['data'],
            'tgl' => $tgl
        ];
        return view('qc.kontrol_grading.index', $data);
    }
    public function print(Request $r)
    {
        if (empty($r->tgl)) {
            $tgl = date('Y-m-d');
        } else {
            $tgl = $r->tgl;
        }
        $grading = Http::get("https://sarang.ptagafood.com/api/apihasap/grading?tgl=$tgl");
        $grading = json_decode($grading, TRUE);
        $data = [
            'title' => 'Kontrol grading',
            'grading' => $grading['data'],
            'tgl' => $tgl
        ];
        return view('qc.kontrol_grading.print', $data);
    }
}

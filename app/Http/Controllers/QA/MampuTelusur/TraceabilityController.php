<?php

namespace App\Http\Controllers\QA\MampuTelusur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TraceabilityController extends Controller
{
    public function index()
    {
        $bk = Http::get("https://sarang.ptagafood.com/api/apihasap/bk_awal");
        $bk = json_decode($bk, TRUE);
        $data = [
            'title' => 'Traceability',
            'bk' => $bk['data'],
        ];
        return view('qa.mampu_telusur.traceability.index', $data);
    }
}

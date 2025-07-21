<?php

namespace App\Http\Controllers\QA\MampuTelusur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TraceabilityController extends Controller
{
    public function index()
    {
        $bk = Http::get("https://sarang.ptagafood.com/api/apihasap/first_tracebelity");
        $bk = json_decode($bk, TRUE);


        $data = [
            'title' => 'Traceability',
            'bk' => $bk['data'],
        ];
        return view('qa.mampu_telusur.traceability.index', $data);
    }

    public function print(Request $r)
    {
        $bk = Http::get("https://sarang.ptagafood.com/api/apihasap/tracebelity1?nm_partai=" . $r->nm_partai);
        $bk = json_decode($bk, TRUE);

        $data = [
            'title' => 'Print Traceability',
            'nm_partai' => $r->nm_partai,
            'bk' => $bk['data'],
        ];
        return view('qa.mampu_telusur.traceability.print', $data);
    }
}

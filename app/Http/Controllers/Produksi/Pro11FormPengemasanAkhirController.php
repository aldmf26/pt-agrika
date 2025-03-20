<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Pro11FormPengemasanAkhirController extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Form Pengemasan Akhir'
        ];
        return view('produksi.pro11_form_pengemasan_akhir.index', $data);
    }

    public function print(Request $r)
    {
        $data = [
            'title' => 'Form Pengemasan Akhir',
            'tgl' => date('Y-m-d')
        ];
        return view('produksi.pro11_form_pengemasan_akhir.print', $data);
    }
}

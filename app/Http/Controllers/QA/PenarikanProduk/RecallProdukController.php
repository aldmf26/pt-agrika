<?php

namespace App\Http\Controllers\QA\PenarikanProduk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecallProdukController extends Controller
{
    public function index()
    {
        $data  = [
            'title' => 'Penarikan Produk'
        ];
        return view('qa.penarikan-produk.index', $data);
    }
}

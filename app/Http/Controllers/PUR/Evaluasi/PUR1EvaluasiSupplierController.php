<?php

namespace App\Http\Controllers\PUR\Evaluasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PUR1EvaluasiSupplierController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'PUR 1 Evaluasi Supplier',
        ];

        return view('pur.evaluasi.supplier.index', $data);
    }
}

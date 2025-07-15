<?php

namespace App\Http\Controllers\PUR\Evaluasi;

use App\Http\Controllers\Controller;
use App\Models\Evaluasi;
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

    public function store(Request $request)
    {
        Evaluasi::create([
            'supplier_id' => $request->id_suplier,
            'periode_evaluasi' => $request->periode,
        ]);

        // Redirect back with a success message
        return redirect()->route('pur.seleksi.1.index')->with('sukses', 'Evaluasi berhasil disimpan.');
    }
}

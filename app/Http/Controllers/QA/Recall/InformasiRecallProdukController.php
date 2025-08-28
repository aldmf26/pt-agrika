<?php

namespace App\Http\Controllers\QA\Recall;

use App\Http\Controllers\Controller;
use App\Models\DataPegawai;
use Illuminate\Http\Request;

class InformasiRecallProdukController extends Controller
{
    public function index()
    {
        $data  = [
            'title' => 'Informasi Recall Produk',
        ];
        return view('qa.recall.informasi_recall_produk.index', $data);
    }

    public function create()
    {
        $data  = [
            'title' => 'Tambah Informasi Recall Produk',
            'namas' => DataPegawai::karyawan()->get(),
        ];
        return view('qa.recall.informasi_recall_produk.create', $data);
    }
}

<?php

namespace App\Http\Controllers\PPC\Gudang_RM;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class RM9KodeBahanBakuKimiaController extends Controller
{
    public function index()
    {
        $barangs = Barang::with('kode_bahan_baku')->latest()->get();
        $data = [
            'title' => 'Kode Bahan Baku dan Kimia',
            'barangs' => $barangs
        ];
        return view('ppc.gudang_rm.kode_bahan_baku_kimia.index', $data);
    }

    public function print()
    {
        $barangs = Barang::with('kode_bahan_baku')->latest()->get();

        $data = [
            'title' => 'KODE BAHAN BAKU DAN BAHAN KIMIA',
            'dok' => 'Dok.No.: FRM.WH.04.02, Rev.00',
            'barangs' => $barangs
        ];
        return view('ppc.gudang_rm.kode_bahan_baku_kimia.print', $data);
    }
}

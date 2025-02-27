<?php

namespace App\Http\Controllers\PPC\Gudang_RM;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class RM8KartuStokController extends Controller
{
    public function index()
    {
        $barangs = Barang::latest()->get();
        $data = [
            'title' => 'Kartu Stok',
            'barangs' => $barangs
        ];
        return view('ppc.gudang_rm.kartu_stok.index', $data);
    }

    public function print(Request $r)
    {
        $barangs = Transaksi::with('barang')->where('barang_id', $r->id)->latest()->get();
        $data = [
            'title' => 'KARTU STOK MATERIAL',
            'dok' => 'Dok.No.: FRM.WH.04.01, Rev.00',
            'barangs' => $barangs
        ];
        return view('ppc.gudang_rm.kartu_stok.print', $data);
    }
    
}

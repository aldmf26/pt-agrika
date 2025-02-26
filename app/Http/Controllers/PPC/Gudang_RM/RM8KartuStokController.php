<?php

namespace App\Http\Controllers\PPC\Gudang_RM;

use App\Http\Controllers\Controller;
use App\Models\Barang;
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
}

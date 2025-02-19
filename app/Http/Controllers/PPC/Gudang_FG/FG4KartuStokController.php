<?php

namespace App\Http\Controllers\PPC\Gudang_FG;

use App\Http\Controllers\Controller;
use App\Models\KartuStok;
use Illuminate\Http\Request;

class FG4KartuStokController extends Controller
{
    public function index()
    {
        $kartu = KartuStok::with('produk')->select('*')
            ->whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                    ->from('kartu_stok')
                    ->groupBy('id_produk');
            })
            ->get();
        $data = [
            'title' => 'Kartu Stok',
            'kartu' => $kartu
        ];
        return view('ppc.gudang_fg.kartu_stok.index', $data);
    }

    public function print($id)
    {
        $kartu = KartuStok::with('produk')->where('id_produk', $id)->latest()->get();
        $data = [
            'title' => 'KARTU STOK PRODUK JADI',
            'dok' => 'Dok.No.: FRM.WH.04.04, Rev.00',
            'kartu' => $kartu

        ];

        return view('ppc.gudang_fg.kartu_stok.print', $data);
    }
}

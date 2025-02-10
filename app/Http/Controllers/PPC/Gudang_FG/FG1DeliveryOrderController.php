<?php

namespace App\Http\Controllers\PPC\Gudang_FG;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FG1DeliveryOrderController extends Controller
{
    public function index()
    {
        
        $data = [
            'title' => 'Delivery Order',
        ];

        return view('ppc.gudang_fg.delivery_order.index', $data);
    }

    public function create()
    {
        $profil = DB::table('profil_perusahaan')->first();
        $produks = Produk::latest()->get();
        $data = [
            'title' => 'Tambah Delivery Order',
            'profil' => $profil,
            'produks' => $produks,
        ];

        return view('ppc.gudang_fg.delivery_order.create', $data);
    }
}

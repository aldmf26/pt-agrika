<?php

namespace App\Http\Controllers\PUR\SeleksiSupplier;

use App\Http\Controllers\Controller;
use App\Models\Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PUR2SeleksiSupplier extends Controller
{
    public function index(Request $r)
    {
        $datas = Suplier::latest()->get();

        $data = [
            'title' => 'PUR 2 Seleksi Supplier',
            'datas' => $datas,
            'rumah_walet' => DB::table('rumah_walet')->get(),
            'k' => $r->k ?? 'satu',
        ];

        return view('pur.seleksi.seleksi_supplier.index', $data);
    }

    public function print(Request $r)
    {

        $data = [
            'title' => 'SELEKSI SUPPLIER MATERIAL/KEMASAN/BARANG/JASA',
            'dok' => 'Dok.No.: FRM.PUR.02.01, Rev.00',
            'rumah_walet' => DB::table('rumah_walet')->where('id', $r->id)->first(),
            'k' => $r->kategori,
            'nama' => $r->nama,
        ];
        return view('pur.seleksi.seleksi_supplier.print', $data);
    }
}

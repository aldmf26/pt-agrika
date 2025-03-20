<?php

namespace App\Http\Controllers\PUR\SeleksiSupplier;

use App\Http\Controllers\Controller;
use App\Models\Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PUR1DaftarSupplierController extends Controller
{
    public function index()
    {
        $datas = Suplier::latest()->get();
        $data = [
            'title' => 'PUR 1 Daftar Supplier',
            'datas' => $datas
        ];

        return view('pur.seleksi.daftar_supplier.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Daftar Supplier',
        ];

        return view('pur.seleksi.daftar_supplier.create', $data);
    }

    public function store(Request $r)
    {
        DB::beginTransaction();

        try {
            Suplier::create([
                'nama_supplier' => $r->nama_supplier,
                'kategori' => $r->jenis_produk,
                'alamat' => $r->alamat_supplier,
                'produsen' => $r->produsen,
                'contact_person' => $r->contact_person,
                'no_telp' => $r->no_telp,
                'ket' => $r->ket,
                'hasil_evaluasi' => $r->hasil,
            ]);

            DB::commit();

            return redirect()->route('pur.seleksi.1.index')->with('sukses', 'Seleksi Supplier berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('pur.seleksi.1.create')->with('error', $e->getMessage());
        }
    }

    public function print()
    {
        $datas = Suplier::latest()->get();
        $data = [
            'title' => 'DAFTAR SUPPLIER & OUTSOURCE TERPILIH',
            'dok' => 'Dok.No.: FRM.PUR.02.01, Rev.00',
            'datas' => $datas
        ];
        return view('pur.seleksi.daftar_supplier.print', $data);
    }
}

<?php

namespace App\Http\Controllers\PUR\SeleksiSupplier;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
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

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Daftar Supplier',
            'supplier' => Suplier::findOrFail($id)->first(),
        ];

        return view('pur.seleksi.daftar_supplier.edit', $data);
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
    public function update(Request $r, $id)
    {
        DB::beginTransaction();

        try {
            Suplier::find($id)->update([
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

            return redirect()->route('pur.seleksi.1.index')->with('sukses', 'Seleksi Supplier berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('pur.seleksi.1.create')->with('error', $e->getMessage());
        }
    }
    public function destroy($id)
    {
        $supplier = Suplier::findOrFail($id);
        $check = PurchaseOrder::where('supplier', $supplier->nama_supplier)->first();
        if ($check) {
            return redirect()->route('pur.seleksi.1.index')->with('error', 'Gagal menghapus, supplier masih digunakan di Purchase Order');
        } else {
            $supplier->delete();
        }

        return redirect()->route('pur.seleksi.1.index')->with('sukses', 'Seleksi Supplier berhasil dihapus');
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

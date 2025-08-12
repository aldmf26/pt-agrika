<?php

namespace App\Http\Controllers\PUR\SeleksiSupplier;

use App\Http\Controllers\Controller;
use App\Models\DetailKetidaksesuaian;
use App\Models\Evaluasi;
use App\Models\PurchaseOrder;
use App\Models\RumahWalet;
use App\Models\Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PUR1DaftarSupplierController extends Controller
{
    public function index(Request $r)
    {
        $kategori = $r->kategori ?? 'barang';
        $datas = Suplier::where('kategori', $kategori)->latest()->get();

        $data = [
            'title' => 'PUR 1 Daftar Supplier',
            'datas' => $datas,
            'rumah_walet' => RumahWalet::get(),
            'kategori' => $kategori,
        ];

        return view('pur.seleksi.daftar_supplier.index', $data);
    }

    public function seleksi(Suplier $supplier)
    {
        $data = [
            'title' => 'Seleksi Supplier',
            'supplier' => $supplier,
            'dok' => 'Dok.No.: FRM.PUR.02.02, Rev.00',
        ];
        return view('pur.seleksi.daftar_supplier.seleksi', $data);
    }

    public function seleksi_sbw(RumahWalet $supplier)
    {
        $data = [
            'title' => 'Seleksi Supplier',
            'supplier' => $supplier,
            'dok' => 'Dok.No.: FRM.PUR.02.02, Rev.00',
        ];
        return view('pur.seleksi.daftar_supplier.seleksi_sbw', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Daftar Supplier',
        ];

        return view('pur.seleksi.daftar_supplier.create', $data);
    }

    public function evaluasi($id)
    {

        $evaluasi = Evaluasi::with(['detail', 'supplier'])->where('id', $id)->first();
        $detailAda = !empty($evaluasi->detail);
        $data = [
            'title' => 'Evaluasi Supplier : ',

            'supplier' => $evaluasi->supplier,
            'evaluasi' => $evaluasi,
            'detailAda' => $detailAda,
        ];

        return view('pur.seleksi.daftar_supplier.evaluasi', $data);
    }

    public function evaluasi_update(Request $r, $id)
    {
        try {
            DB::beginTransaction();
            $evaluasi =  Evaluasi::updateOrCreate(
                [
                    'supplier_id' => $id,
                    'periode_evaluasi' => $r->periode_evaluasi,
                ],
                [
                    'supplier_id' => $id,
                    'periode_evaluasi' => $r->periode_evaluasi,
                ],
            );
            $evaluasi->detail()->delete();

            $evaluasi->detail()->create([
                'jenis_kriteria' => 'harga',
                'tanggal_ketidaksesuaian' => now(),
                'alasan' => $r->harga_keterangan ?? null,
                'penilaian' => $r->harga_penilaian ?? 0,
            ]);

            $evaluasi->detail()->create([
                'jenis_kriteria' => 'komunikasi',
                'tanggal_ketidaksesuaian' => now(),
                'alasan' => $r->harga_keterangan ?? null,
                'penilaian' => $r->harga_penilaian ?? 0,
            ]);

            $kuantitas = collect($r->kuantitas_tanggal)->map(function ($tanggal, $index) use ($r) {
                return [
                    'jenis_kriteria' => 'kuantitas',
                    'tanggal_ketidaksesuaian' => $tanggal,
                    'alasan' => $r->kuantitas_karena[$index] ?? null,
                    'penilaian' => $r->kuantitas_penilaian[$index] ?? 0,
                ];
            });

            $waktu = collect($r->waktu_tanggal)->map(function ($tanggal, $index) use ($r) {
                return [
                    'jenis_kriteria' => 'waktu',
                    'tanggal_ketidaksesuaian' => $tanggal,
                    'alasan' => $r->waktu_karena[$index] ?? null,
                    'penilaian' => $r->waktu_penilaian[$index] ?? 0,
                ];
            });

            $kualitas = collect($r->kualitas_tanggal)->map(function ($tanggal, $index) use ($r) {
                return [
                    'jenis_kriteria' => 'kualitas',
                    'tanggal_ketidaksesuaian' => $tanggal,
                    'alasan' => $r->kualitas_karena[$index] ?? null,
                    'penilaian' => $r->kualitas_penilaian[$index] ?? 0,
                ];
            });

            $evaluasi->detail()->createMany($kuantitas->merge($waktu)->merge($kualitas)->toArray());

            DB::commit();
            return redirect()->route('pur.seleksi.1.index')->with('sukses', 'Evaluasi Supplier berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('pur.seleksi.1.index')->with('error', $e->getMessage());
        }
    }

    public function evaluasi_print(Evaluasi $evaluasi)
    {
        $supplier = Suplier::find($evaluasi->supplier_id)->first();
        $data = [
            'title' => 'EVALUASI SUPPLIER/OUTSOURCE',
            'dok' => 'Dok.No.: FRM.PUR.03.01, Rev.00',
            'evaluasi' => $evaluasi,
            'supplier' => $supplier
        ];
        return view('pur.seleksi.daftar_supplier.print_evaluasi', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Daftar Supplier',
            'supplier' => Suplier::where('id', $id)->first(),
        ];

        return view('pur.seleksi.daftar_supplier.edit', $data);
    }

    public function store(Request $r)
    {
        DB::beginTransaction();

        try {
            for ($i = 0; $i < count($r->nama_supplier); $i++) {
                Suplier::create([
                    'nama_supplier' => $r->nama_supplier[$i],
                    'kategori' => $r->jenis_produk[$i],
                    'alamat' => $r->alamat_supplier[$i],
                    'produsen' => 0,
                    'contact_person' => $r->contact_person[$i],
                    'no_telp' => $r->no_telp[$i],
                    'ket' => $r->keterangan[$i],
                    'hasil_evaluasi' => 0,
                ]);
            }

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
                'produsen' => 0,
                'contact_person' => $r->contact_person,
                'no_telp' => $r->no_telp,
                'ket' => $r->keterangan,
                'hasil_evaluasi' => 0,
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
    public function print(Request $r)
    {
        $datas = Suplier::latest()->get();
        $data = [
            'title' => 'DAFTAR SUPPLIER & OUTSOURCE TERPILIH',
            'dok' => 'Dok.No.: FRM.PUR.02.01, Rev.00',
            'datas' => $datas,
            'rumah_walet' => DB::table('rumah_walet')->get(),
            'k' => $r->kategori,
        ];
        return view('pur.seleksi.daftar_supplier.print', $data);
    }
}

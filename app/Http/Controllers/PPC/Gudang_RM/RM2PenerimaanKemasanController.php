<?php

namespace App\Http\Controllers\PPC\Gudang_RM;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\PenerimaanKemasanHeader;
use App\Models\PurchaseOrder;
use App\Models\Suplier;
use App\Services\TransaksiStokService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RM2PenerimaanKemasanController extends Controller
{
    public function index()
    {
        $penerimaan = PenerimaanKemasanHeader::with('barang', 'supplier')->latest()->get();
        $data = [
            'title' => 'Penerimaan kemasan',
            'penerimaan' => $penerimaan
        ];
        return view('ppc.gudang_rm.penerimaan_kemasan_barang.index', $data);
    }

    public function create()
    {
        $po = PurchaseOrder::with('purchaseRequest.item.barang')->where('status', 'selesai')->latest()->get();
        $data = [
            'title' => 'Penerimaan kemasan',
            'po' => $po,
            'barangs' => Barang::with('kode_bahan_baku')->where('kategori', 'kemasan')->latest()->get(),
        ];
        return view('ppc.gudang_rm.penerimaan_kemasan_barang.create', $data);
    }

    public function store(Request $r)
    {
        dd($r->all());
        DB::beginTransaction();
        $admin = auth()->user()->name;
        try {

            $transaksi = TransaksiStokService::create($r, $admin);


            // Simpan header
            $header = PenerimaanKemasanHeader::create([
                'tanggal_penerimaan' => $r->tgl_penerimaan,
                'id_barang' => $r->id_barang,
                'id_supplier' => $transaksi->supplier_id,
                'no_kendaraan' => $r->no_kendaraan,
                'pengemudi' => $r->pengemudi,
                'jumlah_barang' => $r->jumlah_barang,
                'jumlah_sampel' => $r->jumlah_sampel,
                'kode_lot' => $r->kode_lot,
                'keputusan' => $r->keputusan == 'Diterima dengan Catatan' ? 'Diterima dengan Catatan : ' . $r->keputusan_catatan : $r->keputusan,
            ]);

            // Simpan kriteria quantity
            $header->kriteria()->createMany([
                [
                    'kriteria' => 'Warna termasuk hasil print kemasan',
                    'check_1' => in_array('1', $r->warna) ? true : false,
                    'check_2' => in_array('2', $r->warna) ? true : false,
                ],
                [
                    'kriteria' => 'Kondisi Kemasan',
                    'check_1' => in_array('1', $r->kondisi) ? true : false,
                    'check_2' => in_array('2', $r->kondisi) ? true : false,
                ],
                [
                    'kriteria' => 'ukuran Kemasan',
                    'check_1' => in_array('1', $r->ukuran) ? true : false,
                    'check_2' => in_array('2', $r->ukuran) ? true : false,
                ],
            ]);

            DB::commit();
            return redirect()->route('ppc.gudang-rm.2.index')->with('sukses', 'berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('ppc.gudang-rm.2.create')->with('error', $e->getMessage());
        }
    }

    public function print($id)
    {
        $penerimaan = PenerimaanKemasanHeader::with(['barang', 'supplier', 'kriteria'])
            ->findOrFail($id);
        $data = [
            'title' => 'PENERIMAAN KEMASAN',
            'dok' => 'Dok.No.: FRM.WH.02.02, Rev.01',
            'penerimaan' => $penerimaan
        ];
        return view('ppc.gudang_rm.penerimaan_kemasan_barang.print', $data);
    }
}

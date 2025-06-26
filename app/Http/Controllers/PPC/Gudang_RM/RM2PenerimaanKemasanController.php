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
        $po = PurchaseOrder::with('purchaseRequest.item.barang')
            ->where('status', 'selesai')
            ->latest()
            ->get();

        $data = [
            'title' => 'Penerimaan kemasan',
            'po' => $po,
            'barangs' => Barang::with('kode_bahan_baku')->where('kategori', 'kemasan')->latest()->get(),
        ];
        return view('ppc.gudang_rm.penerimaan_kemasan_barang.create', $data);
    }

    public function store(Request $r)
    {
        DB::beginTransaction(); 
        $admin = auth()->user()->name;
        try {

            $transaksi = TransaksiStokService::create($r, $admin);


            // Simpan header
            for ($i = 0; $i < count($r->id_barang); $i++) {
                $barang = Barang::find($r->id_barang[$i]);
                $jumlahSampel = max(1, round($r->jumlah_barang[$i] * 0.01));

                $header = PenerimaanKemasanHeader::create([
                    'tanggal_penerimaan' => $r->tgl_penerimaan[$i],
                    'id_barang' => $r->id_barang[$i],
                    'id_supplier' => $barang->supplier_id,
                    'no_kendaraan' => $r->no_kendaraan[$i],
                    'pengemudi' => $r->pengemudi[$i],
                    'jumlah_barang' => $r->jumlah_barang[$i],
                    'jumlah_sampel' => $jumlahSampel,
                    'kode_lot' => $r->kode_lot[$i],
                    'no_po' => $r->no_po,
                    'keputusan' => 'Diterima',
                ]);

                // Simpan kriteria quantity
                // $kriterias = ['Warna termasuk hasil print kemasan', 'Kondisi Kemasan', 'Ukuran Kemasan'];
                // $kriteriaData = [];

                // foreach ($kriterias as $label) {
                //     $checkFields = [];
                //     for ($j = 1; $j <= $jumlahSampel; $j++) {
                //         $checkFields['check_' . $j] = true;
                //     }
                //     $checkFields['kriteria'] = $label;

                //     $kriteriaData[] = $checkFields;
                // }

                // $header->kriteria()->createMany($kriteriaData);
            }


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

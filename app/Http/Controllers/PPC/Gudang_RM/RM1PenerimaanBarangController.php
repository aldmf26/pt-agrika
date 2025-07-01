<?php

namespace App\Http\Controllers\PPC\Gudang_RM;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Lot;
use App\Models\PenerimaanHeader;
use App\Models\PurchaseOrder;
use App\Models\Suplier;
use App\Models\Transaksi;
use App\Services\TransaksiStokService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RM1PenerimaanBarangController extends Controller
{
    public function index()
    {
        $penerimaan = PenerimaanHeader::with('barang', 'supplier')->latest()->get();
        $data = [
            'title' => 'Penerimaan Barang',
            'penerimaan' => $penerimaan
        ];
        return view('ppc.gudang_rm.penerimaan_barang.index', $data);
    }

    public function create()
    {
        $po = PurchaseOrder::with('purchaseRequest.item.barang')
            ->where('status', '!=', 'selesai')
            ->orderBy('purchase_orders.created_at', 'desc')
            ->get();
        $data = [
            'title' => 'Penerimaan Barang',
            'po' => $po,

        ];
        return view('ppc.gudang_rm.penerimaan_barang.create', $data);
    }

    public function store(Request $r)
    {
        $admin = auth()->user()->name;
        DB::beginTransaction();
        try {
            $transaksi = TransaksiStokService::create($r, $admin);

            PurchaseOrder::where('no_po', $r->no_po)->update([
                'status' => 'selesai',
            ]);

            // Simpan header
            for ($i = 0; $i < count($r->id_barang); $i++) {
                $barang = Barang::find($r->id_barang[$i]);
                $jumlahSampel = max(1, round($r->jumlah_barang[$i] * 0.01));

                $header = PenerimaanHeader::create([
                    'tanggal_terima' => $r->tgl_penerimaan[$i],
                    'id_barang' => $r->id_barang[$i],
                    'id_supplier' => 2,
                    'no_kendaraan' => $r->no_kendaraan[$i],
                    'pengemudi' => $r->pengemudi[$i],
                    'jumlah_barang' => $r->jumlah_barang[$i],
                    'kode_lot' => $r->kode_lot[$i],
                    'no_po' => $r->no_po,
                    'status_penerimaan' => 'Diterima',
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
            return redirect()->route('ppc.gudang-rm.1.index')->with('sukses', 'berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('ppc.gudang-rm.1.create')->with('error', $e->getMessage());
        }
    }

    public function print($id)
    {
        $penerimaan = PenerimaanHeader::with(['barang', 'supplier', 'kriteria'])
            ->findOrFail($id);



        $data = [
            'title' => 'PENERIMAAN BARANG',
            'dok' => 'Dok.No.: FRM.WH.02.01, Rev.01',
            'penerimaan' => $penerimaan
        ];
        return view('ppc.gudang_rm.penerimaan_barang.print', $data);
    }
}

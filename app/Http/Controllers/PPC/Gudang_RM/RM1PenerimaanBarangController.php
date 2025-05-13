<?php

namespace App\Http\Controllers\PPC\Gudang_RM;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Lot;
use App\Models\PenerimaanHeader;
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
        $data = [
            'title' => 'Penerimaan Barang',
        ];
        return view('ppc.gudang_rm.penerimaan_barang.create', $data);
    }

    public function store(Request $r)
    {
        $admin = auth()->user()->name;
        DB::beginTransaction();
        try {
            $transaksi = TransaksiStokService::create($r, $admin);
            // Simpan header
            $header = PenerimaanHeader::create([
                'tanggal_terima' => $r->tgl_penerimaan,
                'id_barang' => $r->id_barang,
                'id_supplier' => $transaksi->supplier_id,
                'no_kendaraan' => $r->no_kendaraan,
                'pengemudi' => $r->pengemudi,
                'jumlah_barang' => $r->jumlah_barang,
                'kode_lot' => $r->kode_lot,
                'status_penerimaan' => $r->keputusan,
            ]);

            // Simpan kriteria quantity
            $header->kriteria()->createMany([
                [
                    'kriteria' => 'quantity',
                    'check_1' => in_array('1', $r->quantity) ? true : false,
                    'check_2' => in_array('2', $r->quantity) ? true : false,
                    'check_3' => in_array('3', $r->quantity) ? true : false,
                    'catatan' => $r->quantity_catatan
                ],
                [
                    'kriteria' => 'visual',
                    'check_1' => in_array('1', $r->visual) ? true : false,
                    'check_2' => in_array('2', $r->visual) ? true : false,
                    'check_3' => in_array('3', $r->visual) ? true : false,
                    'catatan' => $r->visual_catatan
                ],
            ]);

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

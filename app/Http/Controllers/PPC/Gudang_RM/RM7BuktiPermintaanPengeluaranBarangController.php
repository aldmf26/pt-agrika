<?php

namespace App\Http\Controllers\PPC\Gudang_RM;

use App\Http\Controllers\Controller;
use App\Models\BuktiPermintaanPengeluaranBarang;
use App\Models\LabelIdentitasBahan;
use App\Models\PenerimaanHeader;
use App\Models\PenerimaanKemasanHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RM7BuktiPermintaanPengeluaranBarangController extends Controller
{
    public function index()
    {
        $bukti = BuktiPermintaanPengeluaranBarang::groupBy('nama', 'tgl', 'departemen')
            ->selectRaw('nama, tgl, departemen, count(*) as ttl_produk, sum(pcs) as pcs, sum(gr) as gr')
            ->latest()
            ->get();
        $data = [
            'title' => 'Bukti Permintaan Pengeluaran Barang',
            'buktis' => $bukti
        ];
        return view('ppc.gudang_rm.bukti_permintaan_pengeluaran_barang.index', $data);
    }

    public function create()
    {
        $labels = collect([]);
        $barangs = PenerimaanHeader::with(['barang', 'supplier'])->where('label', 'Y')->get();
        $kemasan = PenerimaanKemasanHeader::with(['barang', 'supplier'])->where('label', 'Y')->get();

        foreach ($barangs as $b) {
            $labels = $labels->concat(collect([$b->id => [
                'kode_lot' => $b->kode_lot,
                'nama_barang' => $b->barang->nama_barang,
                'satuan' => $b->barang->satuan
            ]]));
        }
        foreach ($kemasan as $b) {
            $labels = $labels->concat(collect([$b->id => [
                'kode_lot' => $b->kode_lot,
                'nama_barang' => $b->barang->nama_barang,
                'satuan' => $b->barang->satuan
            ]]));
        }

        $data = [
            'title' => 'Tambah Bukti Permintaan Pengeluaran Barang',
            'labels' => $labels

        ];
        return view('ppc.gudang_rm.bukti_permintaan_pengeluaran_barang.create', $data);
    }

    public function store(Request $r)
    {
        DB::beginTransaction();
        try {
            for ($i = 0; $i < count($r->id_barang); $i++) {
                $barangs = PenerimaanHeader::where('kode_lot', $r->id_barang[$i])->first();
                $kemasan = PenerimaanKemasanHeader::where('kode_lot', $r->id_barang[$i])->first();

                $identitas = $barangs ? 'Barang' : 'Kemasan';
                $idBarang = $barangs ? $barangs->id_barang : $kemasan->id_barang;
                BuktiPermintaanPengeluaranBarang::create([
                    'nama' => $r->nama,
                    'identitas' => $identitas,
                    'departemen' => $r->departemen,
                    'penerima_wr' => $r->penerima_wm,
                    'penerima_pr' => $r->penerima_pr,
                    'tgl' => $r->tgl,
                    'id_barang' => $idBarang,
                    'pcs' => $r->diminta_pcs[$i],
                    'gr' => 0,
                    'no_lot' => $r->kode_lot[$i],
                    'status' => $r->status[$i],

                ]);
            }
            DB::commit();
            return redirect()->route('ppc.gudang-rm.7.index')->with('sukses', 'Data Berhasil Disimpan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('ppc.gudang-rm.7.create')->with('error', $e->getMessage());
        }
    }

    public function print(Request $r)
    {
        $bukti = BuktiPermintaanPengeluaranBarang::with('barang')
            ->where([
                ['nama', $r->nama],
                ['tgl', $r->tgl],
                ['departemen', $r->departemen]
            ])
            ->latest()
            ->get();
        $data = [
            'title' => 'BUKTI PERMINTAAN PENGELUARAN BARANG',
            'dok' => 'Dok.No.: FRM.WH.03.01, Rev.00',
            'buktis' => $bukti
        ];

        return view('ppc.gudang_rm.bukti_permintaan_pengeluaran_barang.print', $data);
    }
}

<?php

namespace App\Http\Controllers\PPC\Gudang_FG;

use App\Http\Controllers\Controller;
use App\Models\KartuStok;
use App\Models\BuktiPenerimaanBarang as PenerimaanBarang;
use App\Models\Produk;
use Illuminate\Http\Request;

class FG3BuktiPenerimaanBarangController extends Controller
{

    public function index()
    {
        $penerimaan = PenerimaanBarang::selectRaw("tanggal_terima, sum(terima) as terima, sum(serah) as serah, count(*) as ttl_item")->latest()->groupBy('tanggal_terima')->get();
        $data = [
            'title' => 'Bukti Penerimaan Barang',
            'penerimaan' => $penerimaan
        ];

        return view('ppc.gudang_fg.bukti_penerimaan_barang.index', $data);
    }
    public function create()
    {
        $produks = Produk::latest()->get();
        $data = [
            'title' => 'Tambah Bukti Penerimaan Barang',
            'produks' => $produks
        ];

        return view('ppc.gudang_fg.bukti_penerimaan_barang.create', $data);
    }


    public function store(Request $r)
    {
        for ($i = 0; $i < count($r->id_produk); $i++) {
            PenerimaanBarang::create([
                'tanggal_terima' => $r->tanggal_terima,
                'id_produk' => $r->id_produk[$i],
                'serah' => $r->serah[$i],
                'terima' => $r->terima[$i],
                'nomor_batch' => $r->nomor_batch[$i],
                'lot' => $r->lot[$i],
                'barcode' => $r->barcode[$i],
                'tanggal_produksi' => $r->tanggal_produksi[$i],
                'status' => $r->status[$i],
                'nama_penerima' => $r->nama_penerima,
                'nama_penyerah' => $r->nama_penyerah,
                'nama_ttd' => $r->nama_ttd,
            ]);

            // Ambil stok terakhir produk ini
            $stokTerakhir = KartuStok::where('id_produk', $r->id_produk[$i])
                ->orderBy('tanggal_transaksi', 'desc')
                ->first();

            $stokAkhir = $stokTerakhir ? $stokTerakhir->stok_akhir + $r->terima[$i] : $r->terima[$i];

            // Catat di kartu stok
            KartuStok::create([
                'id_produk' => $r->id_produk[$i],
                'tanggal_transaksi' => $r->tanggal_terima,
                'stok_masuk' => $r->terima[$i],
                'stok_keluar' => 0, // karena ini penerimaan, stok keluar = 0
                'stok_akhir' => $stokAkhir,
                'nomor_batch' => $r->nomor_batch[$i],
                'gudang' => 'FG', // sesuaikan dengan gudang Anda
                'ttd_petugas' => $r->nama_ttd
            ]);
        }

        return redirect()->route('ppc.gudang-fg.3.index')->with('sukses', 'Data Berhasil Disimpan');
    }
    public function print($tgl)
    {
        $datas = PenerimaanBarang::with('produk')->where('tanggal_terima', $tgl)->get();
        $data = [
            'title' => 'BUKTI PENERIMAAN BARANG',
            'dok' => 'Dok.No.: FRM.WH.04.03, Rev.00',
            'datas' => $datas,
        ];

        return view('ppc.gudang_fg.bukti_penerimaan_barang.print', $data);
    }
}

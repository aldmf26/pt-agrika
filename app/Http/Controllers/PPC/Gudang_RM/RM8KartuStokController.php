<?php

namespace App\Http\Controllers\PPC\Gudang_RM;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BuktiPermintaanPengeluaranBarang;
use App\Models\PenerimaanHeader;
use App\Models\PenerimaanKemasanHeader;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RM8KartuStokController extends Controller
{
    public function index(Request $r)
    {
        $barangs = Barang::latest()->get();

        // Tambahkan stok akhir dihitung manual
        foreach ($barangs as $barang) {
            $id = $barang->id;
            $kategori = $barang->kategori;

            $masuk = ($kategori == 'Kemasan')
                ? PenerimaanKemasanHeader::where('id_barang', $id)->sum('jumlah_barang')
                : PenerimaanHeader::where('id_barang', $id)->sum('jumlah_barang');

            $keluar = BuktiPermintaanPengeluaranBarang::where('id_barang', $id)->sum('pcs');

            $barang->stok_akhir = $masuk - $keluar;
        }
        $sbw = Http::get("https://sarang.ptagafood.com/api/apihasap/stok_grade");
        $sbw = json_decode($sbw, TRUE);
        $sbw = $sbw['data'];

        $data = [
            'title' => 'Kartu Stok',
            'barangs' => $barangs,
            'sbw' => $sbw,
            'k' => $r->k ?? 'satu',
        ];

        return view('ppc.gudang_rm.kartu_stok.index', $data);
    }

    public function print(Request $r)
    {
        $kategori = $r->kategori;
        $masuk = ($kategori == 'Kemasan')
            ? PenerimaanKemasanHeader::with('barang')->where('id_barang', $r->id)->get()
            : PenerimaanHeader::with('barang')->where('id_barang', $r->id)->get();

        $keluar = BuktiPermintaanPengeluaranBarang::with('barang')->where('id_barang', $r->id)->get();

        $transaksiGabung = [];

        // Tambahkan transaksi masuk
        foreach ($masuk as $m) {
            $transaksiGabung[] = [
                'tgl' => $m->tgl,
                'jumlah' => $m->jumlah_barang,
                'jenis' => 'masuk',
                'kode_lot' => $m->kode_lot,
            ];
        }

        // Tambahkan transaksi keluar
        foreach ($keluar as $k) {
            $transaksiGabung[] = [
                'tgl' => $k->tgl,
                'jumlah' => $k->pcs,
                'jenis' => 'keluar',
                'kode_lot' => $k->no_lot,
            ];
        }

        // Urutkan berdasarkan tanggal
        usort($transaksiGabung, fn($a, $b) => strtotime($a['tgl']) <=> strtotime($b['tgl']));

        $sbw = Http::get("https://sarang.ptagafood.com/api/apihasap/stok_grade_detail?id=$r->id");
        $sbw = json_decode($sbw, TRUE);

        // Kirim ke view
        $data = [
            'title' => 'KARTU STOK MATERIAL',
            'dok' => 'Dok.No.: FRM.WH.03.02, Rev.00',
            'transaksi' => $transaksiGabung,
            'barang' => Barang::find($r->id),
            'kategori' => $kategori,
            'nm_barang' => $r->nm_barang ?? '-',
            'sbw' => $sbw['data'],
        ];
        return view('ppc.gudang_rm.kartu_stok.print', $data);
    }
}

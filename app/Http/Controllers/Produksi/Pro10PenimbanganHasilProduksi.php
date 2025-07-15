<?php

namespace App\Http\Controllers\produksi;

use App\Http\Controllers\Controller;
use App\Models\PenimbanganHasilProduksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Pro10PenimbanganHasilProduksi extends Controller
{
    public function index(Request $r)
    {
        $pengemasan = Http::get("https://sarang.ptagafood.com/api/apihasap/pengiriman_akhir");
        $pengemasan = json_decode($pengemasan, TRUE);

        $data = [
            'title' => 'Penimbangan Hasil Produksi',
            'pengemasan' => $pengemasan['data'],
        ];
        return view('produksi.pro10_penimbangan_hasil_produksi.index', $data);
    }

    public function store(Request $r)
    {
        for ($i = 0; $i < count($r->jenis_produk); $i++) {
            $data = [
                'tanggal' => $r->tanggal,
                'jenis_produk' => $r->jenis_produk[$i],
                'kode_batch' => $r->kode_batch[$i],
                'pcs' => $r->pcs[$i],
                'gr' => $r->gr[$i],
                'box' => $r->box[$i],
                'keterangan' => $r->keterangan[$i],
            ];
            PenimbanganHasilProduksi::create($data);
        }

        return redirect()->route('produksi.10.index')->with('sukses', 'Data berhasil disimpan');
    }

    public function print(Request $r)
    {
        $tgl = $r->tgl;
        $pengiriman_akhir = Http::get("https://sarang.ptagafood.com/api/apihasap/pengiriman_akhir_detail_group_grade?tgl=$tgl");
        $pengiriman_akhir = json_decode($pengiriman_akhir, TRUE);
        $data = [
            'title' => 'Penimbangan Hasil Produksi',
            'tgl' => $tgl,
            'penimbangan' => $pengiriman_akhir['data'],

        ];
        return view('produksi.pro10_penimbangan_hasil_produksi.print', $data);
    }
}

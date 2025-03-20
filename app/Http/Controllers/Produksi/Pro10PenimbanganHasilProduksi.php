<?php

namespace App\Http\Controllers\produksi;

use App\Http\Controllers\Controller;
use App\Models\PenimbanganHasilProduksi;
use Illuminate\Http\Request;

class Pro10PenimbanganHasilProduksi extends Controller
{
    public function index(Request $r)
    {
        if (empty($r->tgl)) {
            $tgl = date('Y-m-d');
        } else {
            $tgl = $r->tgl;
        }
        $data = [
            'title' => 'Penimbangan Hasil Produksi',
            'tgl' => $tgl,
            'penimbangan' => PenimbanganHasilProduksi::where('tanggal', $tgl)->get()
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
        if (empty($r->tgl)) {
            $tgl = date('Y-m-d');
        } else {
            $tgl = $r->tgl;
        }
        $data = [
            'title' => 'Penimbangan Hasil Produksi',
            'tgl' => $tgl,
            'penimbangan' => PenimbanganHasilProduksi::where('tanggal', $tgl)->get(),
            'head' => PenimbanganHasilProduksi::where('tanggal', $tgl)->first()
        ];
        return view('produksi.pro10_penimbangan_hasil_produksi.print', $data);
    }
}

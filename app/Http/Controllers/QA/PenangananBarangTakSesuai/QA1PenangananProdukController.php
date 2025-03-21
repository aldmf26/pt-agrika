<?php

namespace App\Http\Controllers\QA\PenangananBarangTakSesuai;

use App\Http\Controllers\Controller;
use App\Models\PenangananProdukTidakSesuai;
use Illuminate\Http\Request;

class QA1PenangananProdukController extends Controller
{
    public function index()
    {
        $penangan = PenangananProdukTidakSesuai::all();
        $data = [
            'title' => 'Penanganan Barang Tak Sesuai',
            'penanganan' => $penangan
        ];
        return view('qa.penanganan_produk.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Penanganan Barang Tak Sesuai',
        ];
        return view('qa.penanganan_produk.create', $data);
    }

    public function store(Request $r)
    {
        PenangananProdukTidakSesuai::create([
            "tgl_kejadian" => $r->tanggal_kejadian,
            "sumber_penyebab" => $r->sumber_penyebab,
            "nama_produk" => $r->nama_produk,
            "kode_produksi" => $r->kode_produksi,
            "jumlah_produk" => $r->jumlah_produk,
            "status" => $r->status,
            "penanganan" => $r->penanganan,
        ]);

        return redirect()->route('qa.penanganan-produk.1.index')->with('sukses', 'Data Berhasil Disimpan');
    }

    public function print($id)
    {
        $datas = PenangananProdukTidakSesuai::find($id)->first();
        $data = [
            'title' => 'PENANGANAN PRODUK TIDAK SESUAI  ',
            'dok' => 'Dok.No.: FRM.QA.02.01, Rev.00',
            'datas' => $datas
        ];
        return view('qa.penanganan_produk.print', $data);
    }

}

<?php

namespace App\Http\Controllers\QA\PenangananBarangTakSesuai;

use App\Http\Controllers\Controller;
use App\Models\BeritaAcaraPemusnahan;
use Illuminate\Http\Request;

class QA2BeritaAcaraPemusnahanProdukController extends Controller
{
    public function index()
    {
        $penangan = BeritaAcaraPemusnahan::all();
        $data = [
            'title' => 'berita acara pemusnahan',
            'penanganan' => $penangan
        ];
        return view('qa.berita_acara_pemusnahan.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'berita acara pemusnahan',
        ];
        return view('qa.berita_acara_pemusnahan.create', $data);
    }

    public function store(Request $r)
    {
        BeritaAcaraPemusnahan::create([
            "tgl" => $r->tgl,
            "nama_produk" => $r->nama_produk,
            "jumlah" => $r->jumlah,
            "cakupan" => $r->cakupan,
            "alasan" => $r->alasan,
        ]);

        return redirect()->route('qa.penanganan-produk.2.index')->with('sukses', 'Data Berhasil Disimpan');
    }

    public function print()
    {
        $datas = BeritaAcaraPemusnahan::latest()->get();
        $data = [
            'title' => 'PENANGANAN PRODUK TIDAK SESUAI  ',
            'dok' => 'Dok.No.:FRM.QA.02.02 , Rev.00',
            'datas' => $datas
        ];
        return view('qa.berita_acara_pemusnahan.print', $data);
    }
}

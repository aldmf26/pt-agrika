<?php

namespace App\Http\Controllers\QA\PenangananBarangTakSesuai;

use App\Http\Controllers\Controller;
use App\Models\BeritaAcaraPemusnahan;
use App\Models\PenangananProdukTidakSesuai;
use Illuminate\Http\Request;

class QA2BeritaAcaraPemusnahanProdukController extends Controller
{
    public function index()
    {
        $penangan = PenangananProdukTidakSesuai::where('status', 'reject')->orderBy('id', 'desc')->get();
        $data = [
            'title' => 'berita acara pemusnahan',
            'penanganan' => $penangan
        ];
        return view('qa.berita_acara_pemusnahan.index', $data);
    }

    public function edit(Request $r)
    {
        $data = [
            'cakupan_pemusnahan' => $r->cakupan,
            'alasan_pemusnahan' => $r->alasan,
            'tgl_pemusnahan' => $r->tgl_pemusnahan,
        ];
        PenangananProdukTidakSesuai::where('id', $r->id)->update($data);

        return redirect()->back()->with('sukses', 'Data Berhasil Disimpan');
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
        $penangan = PenangananProdukTidakSesuai::where('status', 'reject')->orderBy('id', 'desc')->get();
        $data = [
            'title' => 'PENANGANAN PRODUK TIDAK SESUAI  ',
            'dok' => 'Dok.No.:FRM.QA.02.02 , Rev.00',
            'datas' => $penangan
        ];
        return view('qa.berita_acara_pemusnahan.print', $data);
    }
}

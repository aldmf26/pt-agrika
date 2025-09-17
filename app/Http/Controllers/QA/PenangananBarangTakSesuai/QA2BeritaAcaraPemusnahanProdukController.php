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
        $penangan = PenangananProdukTidakSesuai::where('status', 'reject')
            ->with('beritaAcara') // Tambahkan relasi
            ->orderBy('id', 'desc')
            ->get();
        $data = [
            'title' => 'berita acara pemusnahan',
            'penanganan' => $penangan
        ];
        return view('qa.berita_acara_pemusnahan.index', $data);
    }

    public function edit(Request $r)
    {
        // Cek apakah sudah ada data untuk produk ini
        $beritaAcara = BeritaAcaraPemusnahan::where('penanganan_id', $r->id)->first();

        if ($beritaAcara) {
            // Update jika sudah ada
            $beritaAcara->update([
                'cakupan' => $r->cakupan,
                'alasan' => $r->alasan,
                'tgl' => $r->tgl_pemusnahan,
            ]);
            $message = 'Data Berhasil Diupdate';
        } else {
            // Create baru jika belum ada
            BeritaAcaraPemusnahan::create([
                'penanganan_id' => $r->id,
                'cakupan' => $r->cakupan,
                'alasan' => $r->alasan,
                'tgl' => $r->tgl_pemusnahan,
            ]);
            $message = 'Data Berhasil Disimpan';
        }

        return redirect()->back()->with('sukses', $message);
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
        $penangan = PenangananProdukTidakSesuai::where('status', 'reject')
            ->with('beritaAcara') // Tambahkan relasi
            ->orderBy('id', 'desc')
            ->get();

        $data = [
            'title' => 'BERITA ACARA PEMUSNAHAN PRODUK',
            'dok' => 'Dok.No.:FRM.QA.02.02 , Rev.00',
            'datas' => $penangan
        ];
        return view('qa.berita_acara_pemusnahan.print', $data);
    }
}

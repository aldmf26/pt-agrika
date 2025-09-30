<?php

namespace App\Http\Controllers\DCR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BeritaAcaraPemusnahanDokumen extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Berita Acara Pemusnahan Dokumen/Catatan',
            'daftar' => DB::table('daftar_induk_dokumen_internal')->orderBy('no_dokumen', 'asc')->get(),
            'dokumen' => DB::table('berita_acara_pemusnahan as pd')
                ->leftJoin('daftar_induk_dokumen_internal as did', 'pd.dokumen_id', '=', 'did.id')
                ->select('pd.*', 'did.judul', 'did.no_dokumen', 'did.rev', 'did.pic', 'did.nama_divisi')
                ->orderBy('pd.id', 'desc')
                ->get()
        ];
        return view('dcr.berita_acara_pemusnahan.index', $data);
    }

    public function store(Request $r)
    {
        DB::table('berita_acara_pemusnahan')->insert([
            'dokumen_id' => $r->id_dokumen,
            'cakupan_pemusnahan' => $r->cakupan_pemusnahan,
            'inisial' => $r->inisial,
            'alasan_pemusnahan' => $r->alasan_pemusnahan,
            'tgl_pemusnahan' => $r->tgl_pemusnahan,
        ]);
        return redirect()->route('dcr.7.index')->with('sukses', 'Berita acara pemusnahan dokumen berhasil ditambahkan.');
    }

    public function print(Request $r)
    {
        $data = [
            'title' => 'BERITA ACARA PEMUSNAHAN DOKUMEN/CATATAN',
            'dok' => 'Dok.No.: FRM.DCR.01.07, Rev.00',
            'daftar' => DB::table('daftar_induk_dokumen_internal')->orderBy('no_dokumen', 'asc')->get(),
            'dokumen' => DB::table('berita_acara_pemusnahan as pd')
                ->leftJoin('daftar_induk_dokumen_internal as did', 'pd.dokumen_id', '=', 'did.id')
                ->select('pd.*', 'did.judul', 'did.no_dokumen', 'did.rev', 'did.pic', 'did.nama_divisi')
                ->orderBy('pd.id', 'asc')
                ->get()
        ];
        return view('dcr.berita_acara_pemusnahan.print', $data);
    }
}

<?php

namespace App\Http\Controllers\DCR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanKehilanganDokumen extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Laporan Kehilangan Dokumen',
            'daftar' => DB::table('daftar_induk_dokumen_internal')->orderBy('no_dokumen', 'asc')->get(),
            'dokumen' => DB::table('laporan_kehilangan as pd')
                ->leftJoin('daftar_induk_dokumen_internal as did', 'pd.dokumen_id', '=', 'did.id')
                ->select('pd.*', 'did.judul', 'did.no_dokumen', 'did.rev', 'did.pic', 'did.nama_divisi')
                ->orderBy('pd.id', 'desc')
                ->get()
        ];
        return view('dcr.laporan_kehilangan_dokumen.index', $data);
    }


    public function store(Request $r)
    {
        DB::table('laporan_kehilangan')->insert([
            'dokumen_id' => $r->id_dokumen,
            'nm_pelapor' => $r->nm_pelapor,
            'tgl_lapor' => $r->tgl_lapor,
            'penyebab_hilang' => $r->penyebab_hilang,
        ]);
        return redirect()->route('dcr.6.index')->with('sukses', 'Laporan kehilangan dokumen berhasil ditambahkan.');
    }

    public function print(Request $r)
    {
        $data = [
            'title' => 'LAPORAN KEHILANGAN DOKUMEN',
            'dok' => 'Dok.No.: FRM.DCR.01.06, Rev.00',
            'daftar' => DB::table('daftar_induk_dokumen_internal')->orderBy('no_dokumen', 'asc')->get(),
            'dokumen' => DB::table('laporan_kehilangan as pd')
                ->leftJoin('daftar_induk_dokumen_internal as did', 'pd.dokumen_id', '=', 'did.id')
                ->select('pd.*', 'did.judul', 'did.no_dokumen', 'did.rev', 'did.pic', 'did.nama_divisi')
                ->orderBy('pd.id', 'desc')
                ->get()
        ];
        return view('dcr.laporan_kehilangan_dokumen.print', $data);
    }
}

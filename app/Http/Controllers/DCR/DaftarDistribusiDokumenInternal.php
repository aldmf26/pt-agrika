<?php

namespace App\Http\Controllers\DCR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarDistribusiDokumenInternal extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Distribusi Dokumen Internal',
            'daftar' => DB::table('daftar_induk_dokumen_internal as a')
                ->select('a.*',  DB::raw('COUNT(a.nama_divisi) AS jumlah_dokumen'))
                ->groupBy('nama_divisi')->get(),
            'divisi' => DB::table('divisis')->get(),
            'dokumen' => DB::table('daftar_induk_dokumen_internal')->get(),
        ];

        return view('dcr.daftar_distribusi_dokumen_internal.index', $data);
    }

    public function store(Request $request)
    {
        for ($i = 0; $i < count($request->dokumen_id); $i++) {
            DB::table('daftar_distribusi_dokumen_internal')->insert([
                'divisi_id' => $request->divisi_id,
                'dokumen_id' => $request->dokumen_id[$i],

            ]);
        }

        return redirect()->back()->with('sukses', 'Data berhasil ditambahkan');
    }

    public function print(Request $r)
    {
        $data = [
            'title' => 'DAFTAR DISTRIBUSI DOKUMEN INTERNAL',
            'dok' => 'Dok.No.: FRM.DCR.01.04, Rev.00',
            'divisi' => DB::table('divisis')->where('id', $r->divisi_id)->first(),
            'daftar' => DB::table('daftar_induk_dokumen_internal as a')
                ->select('a.*')
                ->where('a.nama_divisi', $r->nama_divisi)
                ->orderBy('a.no_dokumen', 'asc')
                ->get(),
        ];
        return view('dcr.daftar_distribusi_dokumen_internal.print', $data);
    }
}

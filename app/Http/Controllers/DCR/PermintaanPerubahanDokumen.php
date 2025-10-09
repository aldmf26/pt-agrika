<?php

namespace App\Http\Controllers\DCR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermintaanPerubahanDokumen extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Permintaan Pembuatan dan Perubahan Dokumen',
            'daftar' => DB::table('daftar_induk_dokumen_internal')->orderBy('no_dokumen', 'asc')->get(),
            'dokumen' => DB::table('perubahan_dokumen as pd')
                ->leftJoin('daftar_induk_dokumen_internal as did', 'pd.dokumen_id', '=', 'did.id')
                ->select('pd.*', 'did.judul', 'did.no_dokumen', 'did.rev', 'did.pic', 'did.nama_divisi')
                ->orderBy('pd.id', 'desc')
                ->get()
        ];
        return view('dcr.permintaan_perubahan_dokumen.index', $data);
    }

    public function getDokumen(Request $r)
    {

        $dok = DB::table('daftar_induk_dokumen_internal')->where('id', $r->id)->first();
        return response()->json($dok);
    }
    public function print(Request $r)
    {
        $data = [
            'title' => 'PERMINTAAN PEMBUATAN & PERUBAHAN DOKUMEN',
            'dok' => 'Dok.No.: FRM.DCR.01.03, Rev.00',
            'dokumen' => DB::table('perubahan_dokumen as pd')
                ->leftJoin('daftar_induk_dokumen_internal as did', 'pd.dokumen_id', '=', 'did.id')
                ->select('pd.*', 'did.judul', 'did.no_dokumen', 'did.rev', 'did.pic', 'did.nama_divisi')
                ->where('pd.id', $r->id)
                ->orderBy('pd.id', 'desc')
                ->first()
        ];

        return view('dcr.permintaan_perubahan_dokumen.print', $data);
    }

    public function store(Request $r)
    {
        $pengajuan = $r->pengajuan;
        if ($pengajuan == 'perubahan') {
            DB::table('perubahan_dokumen')->insert([
                'dokumen_id' => $r->id_dokumen,
                'ket_detail' => $r->ket_detail,
                'alasan' => $r->alasan,
                'tgl_terbit' => now(),
                'detail' => $pengajuan,

            ]);
        } elseif ($pengajuan == 'pembuatan') {
            $daftarId = DB::table('daftar_induk_dokumen_internal')->insertGetId([
                'nama_divisi' => $r->nm_divisi,
                'pic' => $r->pic,
                'judul' => $r->judul_dokumen,
                'no_dokumen' => $r->no_dokumen,
                'rev' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('perubahan_dokumen')->insert([
                'dokumen_id' => $daftarId,
                'ket_detail' => $r->ket_detail,
                'alasan' => $r->alasan,
                'tgl_terbit' => now(),
                'detail' => $pengajuan,
            ]);
        }
        return redirect()->back()->with('success', 'Permintaan perubahan dokumen berhasil dikirim');
    }
}

<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Pro1PersiapandanPembersihanController extends Controller
{
    public function index()
    {
        (new \App\Jobs\SyncHasapData())->handle();
        $posisi = auth()->user()->posisi_id;

        if ($posisi == 1) {
            $bk = DB::table('persiapan_serah_terima')->orderBy('tgl', 'desc')->groupBy(['tgl', 'nama_petugas'])->select('tgl', 'nama_petugas', 'nama_pencabut', DB::raw('SUM(pcs) as pcs'), DB::raw('SUM(gr) as gr'))->get();
        } else {
            $id_pengawas = auth()->user()->name;
            $bk = DB::table('persiapan_serah_terima')->where('nama_petugas', $id_pengawas)->orderBy('tgl', 'desc')->groupBy(['tgl', 'nama_petugas'])->select('tgl', 'nama_petugas', 'nama_pencabut', DB::raw('SUM(pcs) as pcs'), DB::raw('SUM(gr) as gr'))->get();
        }
        $data = [
            'title' => 'Persiapan dan pembersihan',
            'bk' => $bk
        ];
        return view('produksi.pro1persiapandanpembersihan.index', $data);
    }

    public function print(Request $r)
    {
        $detail = DB::table('persiapan_serah_terima')->where('tgl', $r->tgl)->where('nama_petugas', $r->pengawas)->get();
        $data = [
            'title' => 'Persiapan & Pembersihan',
            'detail' => $detail,
            'pengawas' => $r->pengawas,
            'tanggal' => $r->tgl
        ];
        return view('produksi.pro1persiapandanpembersihan.print', $data);
    }
}

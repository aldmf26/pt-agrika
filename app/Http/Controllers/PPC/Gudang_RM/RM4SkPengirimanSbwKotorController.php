<?php

namespace App\Http\Controllers\PPC\Gudang_RM;

use App\Http\Controllers\Controller;
use App\Models\Ikph;
use App\Models\PenerimaanKemasanSbwKotorHeader;
use App\Models\RumahWalet;
use App\Models\SkPengirimanWalet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RM4SkPengirimanSbwKotorController extends Controller
{
    public function index()
    {
        $sk = DB::table('sbw_kotor')
            ->leftJoin('rumah_walet', 'rumah_walet.id', '=', 'sbw_kotor.rwb_id')
            ->groupBy('rwb_id')->orderBy('sbw_kotor.id', 'desc')
            ->select('rumah_walet.nama as nm_walet', 'rumah_walet.alamat', 'rumah_walet.no_reg', 'sbw_kotor.*')
            ->get();



        $data = [
            'title' => 'Sk Pengiriman Sbw Kotor dari Rumah Walet',
            'sk' => $sk
        ];
        return view('ppc.gudang_rm.sk_pengiriman_sbw_kotor.index', $data);
    }
    // public function create()
    // {
    //     $penerimaanSbwKotors = RumahWalet::latest()->get();
    //     $ikph = Ikph::latest()->get();
    //     $data = [
    //         'title' => 'Tambah Sk Pengiriman Sbw Kotor dari Rumah Walet',
    //         'penerimaanSbwKotors' => $penerimaanSbwKotors,
    //         'ikph' => $ikph
    //     ];
    //     return view('ppc.gudang_rm.sk_pengiriman_sbw_kotor.create', $data);
    // }

    // public function store(Request $r)
    // {
    //     for ($i = 0; $i < count($r->berat_panen); $i++) {
    //         $datas[] = [
    //             'id_penerimaan' => $r->id_penerimaan,
    //             'id_ikph' => $r->id_ikph,
    //             'tujuan_ikph' => $r->tujuan_ikh,
    //             'tanggal_sk_pengiriman' => $r->tgl_bln_thn,
    //             'tanggal_panen' => $r->tgl_panen[$i],
    //             'berat_panen' => $r->berat_panen[$i],
    //             'tanggal_kirim' => $r->tgl_kirim[$i],
    //             'berat_kirim' => $r->berat_kirim[$i],
    //             'keterangan' => $r->keterangan[$i],
    //             'admin' => auth()->user()->name
    //         ];
    //     }

    //     DB::table('sk_pengiriman_walet')->insert($datas);
    //     return redirect()->route('ppc.gudang-rm.4.index')->with('sukses', 'Data berhasil disimpan');
    // }

    public function print($id)
    {
        $sk = DB::table('sbw_kotor')
            ->where('sbw_kotor.rwb_id', $id)
            ->orderBy('sbw_kotor.id', 'desc')
            ->get();
        $data = [
            'title' => 'SURAT KETERANGAN PENGIRIMAN SBW KOTOR DARI RUMAH WALET',
            'dok' => 'Dok.No.: FRM.WH.02.04, Rev.01',
            'sk' => $sk,
            'rumah_walet' => DB::table('rumah_walet')->where('id', $id)->first()
        ];
        return view('ppc.gudang_rm.sk_pengiriman_sbw_kotor.print', $data);
    }
}

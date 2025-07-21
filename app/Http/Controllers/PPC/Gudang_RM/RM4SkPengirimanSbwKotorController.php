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


    public function print($id)
    {
        $sk = DB::table('sbw_kotor')
            ->where('sbw_kotor.rwb_id', $id)
            ->groupBy('sbw_kotor.tgl')
            ->orderBy('sbw_kotor.tgl', 'desc')
            ->select('tgl', DB::raw('SUM(kg) as kg'))
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

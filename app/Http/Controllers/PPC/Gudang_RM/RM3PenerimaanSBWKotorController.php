<?php

namespace App\Http\Controllers\PPC\Gudang_RM;

use App\Http\Controllers\Controller;
use App\Models\PenerimaanKemasanSbwKotorHeader;
use App\Models\RumahWalet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class RM3PenerimaanSBWKotorController extends Controller
{
    public function index()
    {
        $sbw = Http::get("https://gudangsarang.ptagafood.com/api/sbw/sbw_kotor");
        $sbw = json_decode($sbw, TRUE);

        $sbw = $sbw['data']['sbw'];

        DB::table('sbw_kotor')->truncate();
        foreach ($sbw as $s) {
            DB::table('sbw_kotor')->insert([
                'grade_id' => $s['grade_id'],
                'rwb_id' => $s['rwb_id'],
                'nm_partai' => $s['nm_partai'],
                'no_invoice' => $s['no_invoice'],
                'pcs' => $s['pcs'],
                'kg' => $s['kg'],
                'no_kendaraan' => $s['no_kendaraan'],
                'pengemudi' => $s['pengemudi'],
                'tgl' => $s['tgl'],
            ]);
        }

        $data = [
            'title' => 'Penerimaan Sbw Kotor',
            'penerimaan' => DB::table('sbw_kotor')
                ->leftJoin('rumah_walet', 'rumah_walet.id', '=', 'sbw_kotor.rwb_id')
                ->leftJoin('grade_sbw_kotor', 'grade_sbw_kotor.id', '=', 'sbw_kotor.grade_id')
                ->select('grade_sbw_kotor.nama', 'rumah_walet.nama as rumah_walet', 'sbw_kotor.*')
                ->get(),
        ];
        return view('ppc.gudang_rm.penerimaan_sbw_kotor.index', $data);
    }
    public function create()
    {
        $data = [
            'title' => 'Penerimaan Sbw Kotor',
            'rumahWalet' => RumahWalet::all(),
        ];
        return view('ppc.gudang_rm.penerimaan_sbw_kotor.create', $data);
    }


    public function print($id)
    {
        $penerimaan =  DB::table('sbw_kotor')
            ->leftJoin('rumah_walet', 'rumah_walet.id', '=', 'sbw_kotor.rwb_id')
            ->leftJoin('grade_sbw_kotor', 'grade_sbw_kotor.id', '=', 'sbw_kotor.grade_id')
            ->select('grade_sbw_kotor.nama', 'rumah_walet.nama as rumah_walet', 'sbw_kotor.*')
            ->where('sbw_kotor.id', $id)
            ->first();
        $data = [
            'title' => 'PENERIMAAN SBW KOTOR',
            'dok' => 'Dok.No.: FRM.WH.02.03, Rev.01',
            'penerimaan' => $penerimaan,
            'kriteria' => DB::table('kriteria_sbw_kotor')->get(),
        ];
        return view('ppc.gudang_rm.penerimaan_sbw_kotor.print', $data);
    }
}

<?php

namespace App\Http\Controllers\PPC\Gudang_RM;

use App\Http\Controllers\Controller;
use App\Models\PenerimaanKemasanSbwKotorHeader;
use App\Models\RumahWalet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RM3PenerimaanSBWKotorController extends Controller
{
    public function index()
    {
        $penerimaan = PenerimaanKemasanSbwKotorHeader::latest()->get();
        $data = [
            'title' => 'Penerimaan Sbw Kotor',
            'penerimaan' => $penerimaan
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
    
    public function store(Request $r)
    {
        DB::beginTransaction();
        try {
            $rumahWalet = RumahWalet::find($r->id_rumah_walet)->first();

            // Simpan header
            $header = PenerimaanKemasanSbwKotorHeader::create([
                'jenis' => $r->jenis,
                'no_lot' => $r->tgl_penerimaan . '-'. $rumahWalet->no_reg,
                'tgl_penerimaan' => $r->tgl_penerimaan,
                'alamat_rumah_walet' => $rumahWalet->alamat,
                'no_kendaraan' => $r->no_kendaraan,
                'pengemudi' => $r->pengemudi,
                'jumlah_gr' => $r->jumlah_gr,
                'jumlah_pcs' => $r->jumlah_pcs,
                'keputusan' => $r->keputusan,
                'noreg_rumah_walet' => $rumahWalet->no_reg,
                'admin' => auth()->user()->name,
            ]);

            // Simpan kriteria quantity
            $header->kriteria()->createMany([
                [
                    'kriteria' => 'Warna',
                    'check_1' => in_array('1', $r->warna) ? true : false,
                    'check_2' => in_array('2', $r->warna) ? true : false,
                ],
                [
                    'kriteria' => 'Kondisi (bulu berat & ringan, bebas jamur)',
                    'check_1' => in_array('1', $r->kondisi) ? true : false,
                    'check_2' => in_array('2', $r->kondisi) ? true : false,
                ],
                [
                    'kriteria' => 'Grade',
                    'check_1' => in_array('1', $r->grade) ? true : false,
                    'check_2' => in_array('2', $r->grade) ? true : false,
                ],
                [
                    'kriteria' => 'Kadar air',
                    'check_1' => in_array('1', $r->kadar_air) ? true : false,
                    'check_2' => in_array('2', $r->kadar_air) ? true : false,
                ],
            ]);

            DB::commit();
            return redirect()->route('ppc.gudang-rm.3.index')->with('sukses', 'berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('ppc.gudang-rm.3.create')->with('error', $e->getMessage());
        }

    }
    public function print($id) 
    {
        $penerimaan = PenerimaanKemasanSbwKotorHeader::with(['kriteria'])
        ->findOrFail($id);
        $data = [
            'title' => 'PENERIMAAN SBW KOTOR',
            'dok' => 'Dok.No.: FRM.WH.02.03, Rev.01',
            'penerimaan' => $penerimaan
        ];
        return view('ppc.gudang_rm.penerimaan_sbw_kotor.print', $data);
    }
}

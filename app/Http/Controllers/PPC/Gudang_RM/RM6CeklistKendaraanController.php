<?php

namespace App\Http\Controllers\PPC\Gudang_RM;

use App\Http\Controllers\Controller;
use App\Models\CeklisKendaraanSbw;
use App\Models\Identitas;
use App\Models\MasterKondisi;
use App\Models\PenerimaanKemasanSbwKotorHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RM6CeklistKendaraanController extends Controller
{
    public function index()
    {
        // $checklists = CeklisKendaraanSbw::select(
        //     'tanggal', 
        //     'nomor_kendaraan', 
        //     'pengemudi', 
        //     'jenis_kendaraan',
        //     'ekspedisi',
        //     'jam_datang',
        //     'noreg_rumah_walet',
        //     'keputusan',
        //     'pemeriksa',
        //     'komentar'
        // )
        // ->groupBy(
        //     'tanggal',
        //     'nomor_kendaraan',
        //     'pengemudi',
        //     'jenis_kendaraan',
        //     'ekspedisi', 
        //     'jam_datang',
        //     'noreg_rumah_walet',
        //     'keputusan',
        //     'pemeriksa',
        //     'komentar'
        // )
        // ->orderBy('tanggal', 'desc')
        // ->get();

        $checklists = DB::select("SELECT MONTH(a.tgl) as bulan, YEAR(a.tgl) as tahun
        FROM sbw_kotor as a 
        group by MONTH(a.tgl) , YEAR(a.tgl)
        order by YEAR(a.tgl) DESC, 
        MONTH(a.tgl) DESC;");


        $data = [
            'title' => 'Ceklis Kendaraan SBW',
            'checklists' => $checklists
        ];
        return view('ppc.gudang_rm.ceklis_kendaraan.index', $data);
    }
    public function create()
    {
        $penerimaan = PenerimaanKemasanSbwKotorHeader::latest()->get();
        $data = [
            'title' => 'Tambah Ceklis Kendaraan SBW',
            'kondisi' => MasterKondisi::all(),
            'penerimaan' => $penerimaan,
        ];
        return view('ppc.gudang_rm.ceklis_kendaraan.create', $data);
    }

    public function store(Request $r)
    {
        try {
            DB::beginTransaction();
            foreach ($r->nomor_kondisi as $key => $value) {
                CeklisKendaraanSbw::create([
                    'tanggal' => $r->tanggal,
                    'nomor_kendaraan' => $r->nomor_kendaraan,
                    'pengemudi' => $r->pengemudi,
                    'jenis_kendaraan' => $r->jenis_kendaraan,
                    'ekspedisi' => $r->ekspedisi,
                    'jam_datang' => $r->jam_datang,
                    'noreg_rumah_walet' => $r->noreg_rumah_walet,
                    'nomor_kondisi' => $value,
                    'check_wh' => $r->check_wh[$key] ?? null,
                    'check_qa' => $r->check_qa[$key] ?? null,
                    'keputusan' => $r->keputusan,
                    'pemeriksa' => $r->pemeriksa,
                    'komentar' => $r->komentar
                ]);
            }
            DB::commit();
            return redirect()->route('ppc.gudang-rm.6.index')->with('sukses', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function print(Request $r)
    {
        // $checklist = CeklisKendaraanSbw::select(
        //     'tanggal',
        //     'nomor_kendaraan',
        //     'pengemudi',
        //     'jenis_kendaraan',
        //     'ekspedisi',
        //     'jam_datang',
        //     'noreg_rumah_walet',
        //     'keputusan',
        //     'pemeriksa',
        //     'komentar'
        // )
        //     ->where('tanggal', $id)
        //     ->first();

        // $details = CeklisKendaraanSbw::where('tanggal', $id)
        //     ->join('master_kondisi', 'checklist_kendaraan_sbw.nomor_kondisi', '=', 'master_kondisi.id')
        //     ->select('master_kondisi.*', 'checklist_kendaraan_sbw.check_wh', 'checklist_kendaraan_sbw.check_qa')
        //     ->get();

        $checklist = DB::select("SELECT a.nm_partai, a.tgl, a.no_kendaraan, b.nama as nama_suplier, a.pengemudi, c.jam_kedatangan, c.driver, c.no_kendaraan as no_kndraan_new
        FROM sbw_kotor as a 
        left join rumah_walet as b on b.id = a.rwb_id
        left join data_edit_wh as c on c.nm_partai = a.nm_partai
        where MONTH(a.tgl) = '$r->bulan' and YEAR(a.tgl)='$r->tahun'
        group by b.nama, a.tgl
        order by a.tgl ASC
        ");

        $kondisi = DB::table('master_kondisi')->get();



        $data = [
            'title' => 'CHECKLIST KENDARAAN SBW',
            'dok' => 'Dok.No.: FRM.PPCS.01.02, Rev.00',
            'checklist' => $checklist,
            'kondisi' => $kondisi,
            // 'details' => $details
        ];

        return view('ppc.gudang_rm.ceklis_kendaraan.print', $data);
    }
}

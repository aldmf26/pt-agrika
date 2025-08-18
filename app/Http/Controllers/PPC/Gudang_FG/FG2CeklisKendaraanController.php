<?php

namespace App\Http\Controllers\PPC\Gudang_FG;

use App\Http\Controllers\Controller;
use App\Models\ChecklistKendaraan;
use App\Models\MasterKondisi;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class FG2CeklisKendaraanController extends Controller
{
    public function index()
    {
        // $checklists = ChecklistKendaraan::select(
        //     'tanggal',
        //     'nomor_kendaraan',
        //     'pengemudi',
        //     'jenis_kendaraan',
        //     'ekspedisi',
        //     'jam_datang',
        //     'tujuan',
        //     'customer',
        //     'negara',
        //     'keputusan',
        //     'pemeriksa',
        //     'komentar'
        // )
        //     ->groupBy(
        //         'tanggal',
        //         'nomor_kendaraan',
        //         'pengemudi',
        //         'jenis_kendaraan',
        //         'ekspedisi',
        //         'jam_datang',
        //         'tujuan',
        //         'customer',
        //         'negara',
        //         'keputusan',
        //         'pemeriksa',
        //         'komentar'
        //     )
        //     ->orderBy('tanggal', 'desc')
        //     ->get();

        $pengiriman = Http::get("https://sarang.ptagafood.com/api/apihasap/pengiriman_bulan");
        $pengiriman = json_decode($pengiriman, TRUE);


        $data = [
            'title' => 'Ceklis Kendaraan',
            'pengiriman' => $pengiriman['data']

        ];
        return view('ppc.gudang_fg.ceklis_kendaraan.index', $data);
    }
    public function create()
    {
        $data = [
            'title' => 'Ceklis Kendaraan',
            'kondisi' => MasterKondisi::all()
        ];
        return view('ppc.gudang_fg.ceklis_kendaraan.create', $data);
    }

    public function store(Request $r)
    {
        $r->validate([
            'tanggal' => 'required|date',
            'nomor_kendaraan' => 'required',
            'pengemudi' => 'required',
            'jenis_kendaraan' => 'required',
            'jam_datang' => 'required',
            'tujuan' => 'required',
            'customer' => 'required',
            'negara' => 'required'
        ]);

        foreach ($r->nomor_kondisi as $key => $value) {
            ChecklistKendaraan::create([
                'tanggal' => $r->tanggal,
                'nomor_kendaraan' => $r->nomor_kendaraan,
                'pengemudi' => $r->pengemudi,
                'jenis_kendaraan' => $r->jenis_kendaraan,
                'ekspedisi' => $r->ekspedisi,
                'jam_datang' => $r->jam_datang,
                'tujuan' => $r->tujuan,
                'customer' => $r->customer,
                'negara' => $r->negara,
                'nomor_kondisi' => $value,
                'check_wh' => $r->check_wh[$key] ?? null,
                'check_qa' => $r->check_qa[$key] ?? null,
                'keputusan' => $r->keputusan,
                'pemeriksa' => $r->pemeriksa,
                'komentar' => $r->komentar
            ]);
        }

        return redirect()->route('ppc.gudang-fg.2.index')->with('sukses', 'Data berhasil disimpan');
    }

    public function print(Request $r)
    {

        $checklist =   Http::get("https://sarang.ptagafood.com/api/apihasap/pengiriman_bulan_detaiil?bulan=$r->bulan&tahun=$r->tahun");
        $checklist = json_decode($checklist, TRUE);
        $kondisi = DB::table('master_kondisi')->get();
        $data = [
            'title' => 'CHECKLIST KENDARAAN UNTUK PENGIRIMAN FINISHED GOODS',
            'dok' => 'Dok.No.: FRM.WH.04.02, Rev.00',
            'checklist' => $checklist['data'],
            'bulan' => $r->bulan,
            'tahun' => $r->tahun,
            'kondisi' => $kondisi

        ];

        return view('ppc.gudang_fg.ceklis_kendaraan.print', $data);
    }
}

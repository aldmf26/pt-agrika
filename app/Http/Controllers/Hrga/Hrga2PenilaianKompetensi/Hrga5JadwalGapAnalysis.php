<?php

namespace App\Http\Controllers\Hrga\Hrga2PenilaianKompetensi;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\JadwalGapAnalysis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hrga5JadwalGapAnalysis extends Controller
{
    public function index(Request $r)
    {
        if (empty($r->tahun)) {
            $tahun = date('Y');
        } else {
            $tahun = $r->tahun;
        }
        $data = [
            'title' => 'Jadwal Gap Analysis',
            'jadwal' => JadwalGapAnalysis::where('tahun_rencana', $tahun)->get(),
            'divisi' => Divisi::all(),
            'bulan' => DB::table('bulan')->get(),
            'tahun' => $tahun,
            'tahuns' => JadwalGapAnalysis::select('tahun_rencana')->distinct()->pluck('tahun_rencana'),
            'tgl' => ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'],
        ];
        return view('hrga.hrga2.hrga5_jadwal_gap_analysis.index', $data);
    }

    public function store(Request $r)
    {
        $data = [
            'divisi_id' => $r->divisi_id,
            'bulan_rencana' => $r->bulan,
            'tahun_rencana' => $r->tahun,
            'tgl_dari' => $r->tgl_mulai,
            'tgl_sampai' => $r->tgl_selesai,
        ];

        JadwalGapAnalysis::create($data);
        return redirect()->route('hrga2.5.index')->with('sukses', 'Data Berhasil Disimpan');
    }

    public function print(Request $r)
    {
        if (empty($r->tahun)) {
            $tahun = date('Y');
        } else {
            $tahun = $r->tahun;
        }
        $data = [
            'title' => 'Jadwal Gap Analysis',
            'jadwal' => JadwalGapAnalysis::where('tahun_rencana', $tahun)->get(),
            'divisi' => Divisi::all(),
            'bulan' => DB::table('bulan')->get(),
            'tahun' => $tahun,
            'tahuns' => JadwalGapAnalysis::select('tahun_rencana')->distinct()->pluck('tahun_rencana')
        ];
        return view('hrga.hrga2.hrga5_jadwal_gap_analysis.print', $data);
    }
}

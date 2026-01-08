<?php

namespace App\Http\Controllers\Hrga\Hrga3Pelatihan;

use App\Http\Controllers\Controller;
use App\Models\DataPegawai;
use App\Models\Divisi;
use App\Models\JadwalInformasiPelatihan;
use App\Models\ProgramPelatihanTahunan;
use App\Models\usulanDanIdentifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hrga2ProgramPelatihanTahunan extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Program Pelatihan Tahunan',
            'program' => ProgramPelatihanTahunan::all(),
            'tahuns' => ProgramPelatihanTahunan::selectRaw('YEAR(tgl_rencana) as tahun')->distinct()->get(),
            'karyawan' => DataPegawai::all()
        ];
        return view('hrga.hrga3.hrga2pelatihantahunan.index', $data);
    }

    public function edit(Request $r)
    {
        $nota_pelatihan = $r->notapelatihan;

        $data = [
            'nota_pelatihan' => $nota_pelatihan,
            'karyawan' => DataPegawai::all(),
            'program' => ProgramPelatihanTahunan::where('nota_pelatihan', $nota_pelatihan)->first(),
            'usulan' =>  usulanDanIdentifikasi::where('nota_pelatihan', $nota_pelatihan)->first(),
            'jadwal' => JadwalInformasiPelatihan::where('nota_pelatihan', $nota_pelatihan)->first(),
            'evaluasi' => DB::table('evaluasi_pelatihan')->where('nota_pelatihan', $nota_pelatihan)->first(),

        ];

        return view('hrga.hrga3.hrga2pelatihantahunan.edit', $data);
    }

    public function store(Request $r)
    {
        for ($i = 0; $i < count($r->id); $i++) {
            $data = [
                'sumber' => $r->sumber[$i],
                'narasumber' => $r->narasumber[$i],
                'tgl_rencana' => $r->tgl_rencana[$i],
                'tgl_realisasi' => $r->tgl_realisasi[$i],
                'sasaran_peserta' => $r->sasaran_peserta[$i],
            ];
            ProgramPelatihanTahunan::where('id', $r->id[$i])->update($data);
        }

        return redirect()->back()->with('sukses', 'Data berhasil di edit');
    }

    public function print(Request $r)
    {
        $data = [
            'title' => 'PROGRAM PELATIHAN TAHUNAN',
            'dok' => 'Dok.No.: FRM.HRGA.03.02, Rev.00',
            'program' => ProgramPelatihanTahunan::whereYear('tgl_rencana', $r->tahun)->get(),
            'bulan' => DB::table('bulan')->get(),
            'tahun' => $r->tahun,
        ];
        return view('hrga.hrga3.hrga2pelatihantahunan.print', $data);
    }
}

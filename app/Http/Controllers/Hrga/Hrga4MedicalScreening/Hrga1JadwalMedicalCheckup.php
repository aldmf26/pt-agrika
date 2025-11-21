<?php

namespace App\Http\Controllers\Hrga\Hrga4MedicalScreening;

use App\Http\Controllers\Controller;
use App\Models\DataPegawai;
use App\Models\Divisi;
use App\Models\JadwalMedicalModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hrga1JadwalMedicalCheckup extends Controller
{
    public function index(Request $r)
    {
        $tahun = empty($r->tahun) ? date('Y') : $r->tahun;
        $divisi = $r->divisi == 'All' ? '' : $r->divisi;

        $data = [
            'title' => 'Jadwal Medical Checkup',
            'jadwal' => JadwalMedicalModel::when(!empty($divisi), function ($query) use ($divisi) {
                $query->whereHas('data_pegawai', function ($query) use ($divisi) {
                    $query->where('divisi_id', $divisi);
                });
            })
                ->where('tahun', $tahun)
                ->get(),
            'bulan' => DB::table('bulan')->get(),
            'tahun' => $tahun,
            'nm_divisi' => Divisi::find($divisi),
            'id_divisi' => $r->divisi,
            'divisi' => Divisi::all(),
            'tahuns' => JadwalMedicalModel::select('tahun')->distinct()->get(),

        ];
        return view('hrga.hrga4.hrga1jadwalmedicalcheckup.index', $data);
    }

    public function editbulan(Request $r)
{
    $update = JadwalMedicalModel::where('id', $r->id)
        ->update([
            'bulan' => $r->bulan,
            'tahun' => $r->tahun,
        ]);

    return response()->json([
        'success' => true,
        'new_bulan' => $r->bulan
    ]);
}


    public function getPegawai(Request $r)
    {

        if ($r->divisi == 'All') {

            $pegawai = DataPegawai::get();
        } else {
            dd('keisni');
            $pegawai = DataPegawai::where('divisi_id', $r->divisi)->get();
        }

        return view('hrga.hrga4.hrga1jadwalmedicalcheckup.getpegawai', compact('pegawai'));
    }

    public function store(Request $r)
    {
        for ($i = 0; $i < count($r->id_pegawai); $i++) {
            $data = [
                'id_karyawan' => $r->id_pegawai[$i],
                'bulan' => $r->bulan,
                'tahun' => $r->tahun,
            ];
            JadwalMedicalModel::create($data);
        }
        return redirect()->route('hrga4.1.index', ['tahun' => $r->tahun])->with('sukses', 'Data Berhasil Disimpan');
    }

    public function print(Request $r)
    {
        $tahun = empty($r->tahun) ? date('Y') : $r->tahun;
        $divisi = $r->divisi == 'All' ? '' : $r->divisi;

        $data = [
            'title' => 'Jadwal Medical Checkup',
            'jadwal' => JadwalMedicalModel::when(!empty($divisi), function ($query) use ($divisi) {
                $query->whereHas('data_pegawai', function ($query) use ($divisi) {
                    $query->where('divisi_id', $divisi);
                });
            })
                ->where('tahun', $tahun)
                ->get(),
            'bulan' => DB::table('bulan')->get(),
            'tahun' => $tahun,
            'divisi' => Divisi::all(),
            'tahuns' => JadwalMedicalModel::select('tahun')->distinct()->get(),

        ];
        return view('hrga.hrga4.hrga1jadwalmedicalcheckup.print', $data);
    }
}

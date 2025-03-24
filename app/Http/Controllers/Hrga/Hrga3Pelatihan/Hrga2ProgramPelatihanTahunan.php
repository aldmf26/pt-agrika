<?php

namespace App\Http\Controllers\Hrga\Hrga3Pelatihan;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\ProgramPelatihanTahunan;
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
            'divisi' => Divisi::all(),

        ];
        return view('hrga.hrga3.hrga2pelatihantahunan.index', $data);
    }

    public function store(Request $r)
    {
        for ($i = 0; $i < count($r->id); $i++) {
            $data = [
                'sumber' => $r->sumber[$i],
                'narasumber' => $r->narasumber[$i],
                'tgl_rencana' => $r->tgl_rencana[$i],
                'tgl_realisasi' => $r->tgl_realisasi[$i],
            ];
            ProgramPelatihanTahunan::where('id', $r->id[$i])->update($data);
        }

        return redirect()->back()->with('sukses', 'Data berhasil di edit');
    }

    public function print(Request $r)
    {
        $data = [
            'title' => 'Informasi Tawaran Pelatihan',
            'program' => ProgramPelatihanTahunan::whereYear('tgl_rencana', $r->tahun)->get(),
            'bulan' => DB::table('bulan')->get(),
            'tahun' => $r->tahun,
        ];
        return view('hrga.hrga3.hrga2pelatihantahunan.print', $data);
    }
}

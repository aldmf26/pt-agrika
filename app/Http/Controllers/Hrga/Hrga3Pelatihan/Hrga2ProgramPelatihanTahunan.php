<?php

namespace App\Http\Controllers\Hrga\Hrga3Pelatihan;

use App\Http\Controllers\Controller;
use App\Models\ProgramPelatihanTahunan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hrga2ProgramPelatihanTahunan extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Informasi Tawaran Pelatihan',
            'program' => ProgramPelatihanTahunan::all(),
            'tahuns' => ProgramPelatihanTahunan::selectRaw('YEAR(tgl_rencana) as tahun')->distinct()->get(),

        ];
        return view('hrga.hrga3.hrga2pelatihantahunan.index', $data);
    }

    public function store(Request $r)
    {
        $r->validate([
            'materi_pelatihan' => 'required',
            'sumber' => 'required',
            'narasumber' => 'required',
            'sasaran_peserta' => 'required',
            'tgl_rencana' => 'required',
            'tgl_realisasi' => 'required',
        ]);
        ProgramPelatihanTahunan::create($r->all());
        return redirect()->back()->with('sukses', 'Data berhasil ditambahkan');
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

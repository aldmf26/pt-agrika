<?php

namespace App\Http\Controllers\Hrga\Hrga2PenilaianKompetensi;

use App\Http\Controllers\Controller;
use App\Models\DataPegawai;
use App\Models\SumPenilaianKompetensi;
use App\Services\DataPegawaiService;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Hrga2PenilaianKompetensi extends Controller
{
    public function index()
    {
        $datas = DataPegawai::with('divisi')->orderBy('tgl_masuk', 'desc')->get();
        $data = [
            'title' => 'Hrga 2 penilaian kompetensi',
            'datas' => $datas
        ];
        return view('hrga.hrga2.hrga2_penilaian_kompetensi.index', $data);
    }

    public function singkron(DataPegawaiService $dataPegawaiService)
    {
        try {
            $dataPegawaiService->download();
            session()->flash('sukses', 'Data pegawai berhasil diunduh.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    public function penilaian($id)
    {
        $datas = DataPegawai::where('karyawan_id_dari_api', $id)->first();
        $data = [
            'title' => 'Penilaian Kompetensi',
            'karyawan' => $datas
        ];
        return view('hrga.hrga2.hrga2_penilaian_kompetensi.penilaian', $data);
    }

    public function print($id)
    {
        $datas = SumPenilaianKompetensi::with(['kompetensi', 'kehadiran', 'parameter', 'suratPeringatan'])->where('id', $id)->first();
        if (count($datas->parameter) < 1) {
            return redirect()->back()->with('error', 'Data penilaian kompetensi tidak lengkap. Silakan lengkapi data terlebih dahulu.');
        }

        $data = [
            'title' => 'LEMBAR PENILAIAN KOMPETENSI KARYAWAN',
            'dok' => 'Dok.No.: FRM.HRGA.02.01, Rev.00',
            'karyawan' => $datas,
            'datas' => $datas,
        ];
        return view('hrga.hrga2.hrga2_penilaian_kompetensi.print', $data);
    }
}

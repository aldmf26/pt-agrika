<?php

namespace App\Http\Controllers\Hrga\Hrga2PenilaianKompetensi;

use App\Http\Controllers\Controller;
use App\Models\DataPegawai;
use App\Services\DataPegawaiService;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Hrga2PenilaianKompetensi extends Controller
{
    public function index()
    {
        $datas = DataPegawai::hasilEvaluasi();
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
        $datas = DataPegawai::oneHasilEvaluasi($id);
        $data = [
            'title' => 'Penilaian Kompetensi',
            'karyawan' => $datas
        ];
        return view('hrga.hrga2.hrga2_penilaian_kompetensi.penilaian', $data);
    }

    public function print($id, $divisi_id)
    {
        if ($divisi_id == 10 || $divisi_id == 4) {
            $nama = DataPegawai::where('karyawan_id_dari_api', $id)->first()->nama;
            $url = "https://absensi.ptagafood.com/api/absen/$nama";
        } else {
            $url = "https://sarang.ptagafood.com/api/data-pegawai/$id";
        }

        $response = Http::get($url);

        $dataPegawai = $response->json();
        $datas = DataPegawai::oneHasilEvaluasi($id);
        $data = [
            'title' => 'LEMBAR PENILAIAN KOMPETENSI KARYAWAN',
            'dok' => 'Dok.No.: FRM.HRGA.02.02, Rev.00',
            'karyawan' => $datas,
            'absen' => $dataPegawai,
            'divisi_id' => $divisi_id
        ];
        return view('hrga.hrga2.hrga2_penilaian_kompetensi.print', $data);
    }
}

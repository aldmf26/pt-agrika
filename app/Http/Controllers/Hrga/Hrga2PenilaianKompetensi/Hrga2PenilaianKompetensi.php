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
        $datas = SumPenilaianKompetensi::with(['kompetensi', 'kehadiran', 'parameter', 'suratPeringatan'])->find($id)->first();

        $data = [
            'title' => 'LEMBAR PENILAIAN KOMPETENSI KARYAWAN',
            'dok' => 'Dok.No.: FRM.HRGA.02.01, Rev.00',
            'karyawan' => $datas,
            'datas' => $datas,
        ];
        return view('hrga.hrga2.hrga2_penilaian_kompetensi.print', $data);
    }

    public function savePenilaianJson($id, $divisi_id)
    {
        // Path ke file JSON
        $file = 'penilaian/penilaian.json';

        // Baca file JSON atau buat array kosong jika belum ada
        $penilaianData = Storage::exists($file) ? json_decode(Storage::get($file), true) : [];
        // Cek apakah ID karyawan sudah ada di JSON
        if (!isset($penilaianData[$id])) {
            // Generate nilai acak jika belum ada
            $penilaianData[$id] = [
                ['Disiplin', rand(85, 95)],
                ['Sikap Kerja', rand(80, 90)],
                ['Kerjasama', rand(80, 90)],
                ['Tanggung jawab', rand(85, 95)],
                ['Kesopanan', rand(85, 95)],
                ['Kejujuran', rand(90, 100)],
                ['Kerapian', rand(80, 90)],
                ['Inisiatif', rand(80, 90)],
                ['Pengetahuan', rand(85, 95)],
                ['Keahlian', rand(85, 95)],
                ['Leadership', $divisi_id == 1 ? 'N/A' : rand(80, 90)],
                ['Manajerial', $divisi_id == 1 ? 'N/A' : rand(80, 90)],
            ];
            // Simpan kembali ke file JSON
            Storage::put($file, json_encode($penilaianData, JSON_PRETTY_PRINT));
        }

        // Ambil data penilaian untuk ID karyawan
        $parameters = $penilaianData[$id];

        // Hitung total
        $total = collect($parameters)
            ->filter(fn($param) => is_numeric($param[1]))
            ->sum(fn($param) => $param[1]);

        return [
            'parameters' => $parameters,
            'total' => $total,
        ];
    }
}

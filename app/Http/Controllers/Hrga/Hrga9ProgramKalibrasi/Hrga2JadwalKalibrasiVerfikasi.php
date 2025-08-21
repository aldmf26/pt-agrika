<?php

namespace App\Http\Controllers\Hrga\Hrga9ProgramKalibrasi;

use App\Http\Controllers\Controller;
use App\Models\hrga9_1KalibrasiModel;
use App\Models\ItemKalibrasiModel;
use App\Models\JadwalKalibrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hrga2JadwalKalibrasiVerfikasi extends Controller
{
    public function index(Request $r)
    {
        if (empty($r->tahun)) {
            $tahun = date('Y');
        } else {
            $tahun = $r->tahun;
        }

        $data = [
            'title' => 'FRM.HRGA.09.02 - HASIL SUMMARY KALIBRASI',
            'bulan' => DB::table('bulan')->get(),
            'tahun' => $tahun,
            'jadwal' => JadwalKalibrasi::whereYear('tanggal', $tahun)->get(),
            'item' => ItemKalibrasiModel::all(),
        ];
        return view('hrga.hrga9.hrga2_jadwalkalibrasi.index', $data);
    }

    public function print(Request $r)
    {
        if (empty($r->tahun)) {
            $tahun = date('Y');
        } else {
            $tahun = $r->tahun;
        }
        $data = [
            'title' => 'FRM.HRGA.09.02 - JADWAL KALIBRASI VERIFIKASI',
            'bulan' => DB::table('bulan')->get(),
            'jadwal' => JadwalKalibrasi::whereYear('tanggal', $tahun)->get(),
            'tahun' => $tahun,
        ];
        return view('hrga.hrga9.hrga2_jadwalkalibrasi.print', $data);
    }

    public function store(Request $r)
    {
        JadwalKalibrasi::create([
            'item_kalibrasi_id' => $r->item_kalibrasi_id,
            'frekuensi' => $r->frekuensi,
            'rentang' => $r->rentang,
            'resolusi' => $r->resolusi,
            'tanggal' => $r->tanggal,
            'standar_nilai' => $r->standart,
            'aktual_nilai' => $r->aktual,
            'status' => $r->status,
            'tanggal_selanjutnya' => $r->tgl_selanjutnya,
        ]);

        hrga9_1KalibrasiModel::create([
            'item_kalibrasi_id' => $r->item_kalibrasi_id,
            'rentang' => $r->rentang,
            'resolusi' => $r->resolusi,
            'frekuensi' => $r->frekuensi,
            'bulan' => date('m', strtotime($r->tanggal)),
            'tahun' => date('Y', strtotime($r->tanggal)),
        ]);
        $tahun = date('Y', strtotime($r->tanggal));
        return redirect()->route('hrga9.2.index', ['tahun' => $tahun])->with('success', 'Data Berhasil Disimpan');
    }
}

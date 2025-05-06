<?php

namespace App\Http\Controllers\Qc;

use App\Http\Controllers\Controller;
use App\Models\ReleaseCuciTerakhir as ModelsReleaseCuciTerakhir;
use Illuminate\Http\Request;

class ReleaseCuciTerakhir extends Controller
{
    public function Index(Request $r)
    {
        $bulan = empty($r->bulan) ? date('m') : $r->bulan;
        $tahun = empty($r->tahun) ? date('Y') : $r->tahun;
        $data = [
            'title' => 'Release cuci terakhir',
            'datas' => ModelsReleaseCuciTerakhir::whereMonth('tgl', $bulan)->whereYear('tgl', $tahun)->orderBy('id', 'desc')->get(),
            'bulan' => $bulan,
            'tahun' => $tahun,
        ];
        return view('qc.release-cuci-terakhir.index', $data);
    }

    public function store(Request $r)
    {
        for ($i = 0; $i < count($r->jam); $i++) {
            $release = ModelsReleaseCuciTerakhir::max('no_urut');
            $data = [
                'jam' => $r->jam[$i],
                'nama_produk' => $r->nama_produk[$i],
                'no_urut' => empty($release) ? 5001 : $release + 1,
                'tgl' => $r->tgl[$i],
                'hasil_pemeriksaan' => $r->hasil_pemeriksaan[$i],
                'status' => $r->status[$i],
                'keterangan' => $r->keterangan[$i],
            ];
            ModelsReleaseCuciTerakhir::create($data);
        }

        return redirect()->back()->with('sukses', 'Data Release cuci terakhir berhasil disimpan');
    }

    public function print(Request $r)
    {
        $bulan = empty($r->bulan) ? date('m') : $r->bulan;
        $tahun = empty($r->tahun) ? date('Y') : $r->tahun;
        $data = [
            'title' => 'Release cuci terakhir',
            'datas' => ModelsReleaseCuciTerakhir::whereMonth('tgl', $bulan)->whereYear('tgl', $tahun)->orderBy('id', 'desc')->get(),
            'bulan' => $bulan,
            'tahun' => $tahun,
        ];
        return view('qc.release-cuci-terakhir.print', $data);
    }
}

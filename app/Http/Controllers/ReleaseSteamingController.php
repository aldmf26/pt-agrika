<?php

namespace App\Http\Controllers;

use App\Models\ReleaseSteaming;
use Illuminate\Http\Request;

class ReleaseSteamingController extends Controller
{
    public function Index(Request $r)
    {
        $bulan = empty($r->bulan) ? date('m') : $r->bulan;
        $tahun = empty($r->tahun) ? date('Y') : $r->tahun;
        $data = [
            'title' => 'Release Steaming',
            'datas' => ReleaseSteaming::whereMonth('tgl', $bulan)->whereYear('tgl', $tahun)->orderBy('id', 'desc')->get(),
            'bulan' => $bulan,
            'tahun' => $tahun,
        ];
        return view('qc.release-steaming.index', $data);
    }

    public function store(Request $r)
    {
        for ($i = 0; $i < count($r->jam_sampling); $i++) {
            $release = ReleaseSteaming::max('no_urut');
            $data = [
                'jam_sampling' => $r->jam_sampling[$i],
                'nomor_urut_mesin_steam' => $r->nomor_urut_mesin_steam[$i],
                'nama_produk' => $r->nama_produk[$i],
                'no_urut' => empty($release) ? 5001 : $release + 1,
                'tgl' => $r->tgl[$i],
                'hasil_pemeriksaan' => $r->hasil_pemeriksaan[$i],
                'status' => $r->status[$i],
                'keterangan' => $r->keterangan[$i],
            ];
            ReleaseSteaming::create($data);
        }

        return redirect()->back()->with('sukses', 'Data Release Steaming Berhasil Disimpan');
    }

    public function print(Request $r)
    {
        $bulan = empty($r->bulan) ? date('m') : $r->bulan;
        $tahun = empty($r->tahun) ? date('Y') : $r->tahun;
        $data = [
            'title' => 'Release Steaming',
            'datas' => ReleaseSteaming::whereMonth('tgl', $bulan)->whereYear('tgl', $tahun)->orderBy('id', 'desc')->get(),
        ];
        return view('qc.release-steaming.print', $data);
    }
}

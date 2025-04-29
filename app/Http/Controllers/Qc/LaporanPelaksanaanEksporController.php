<?php

namespace App\Http\Controllers\Qc;

use App\Http\Controllers\Controller;
use App\Models\LaporanPelaksanaanEkspor;
use Illuminate\Http\Request;

class LaporanPelaksanaanEksporController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Laporan Pelaksanaan Ekspor Sarang Burung Walet',
            'laporan' => LaporanPelaksanaanEkspor::all(),
        ];
        return view('qc.laporan-pelaksanaan-ekspor.index', $data);
    }

    public function store(Request $request)
    {

        for ($i = 0; $i < count($request->nama); $i++) {
            $data = [
                'nama' => $request->nama[$i],
                'tanggal' => $request->tanggal[$i],
                'uraian_barang' => $request->uraian_barang[$i],
                'nomor_pos' => $request->nomor_pos[$i],
                'volume' => $request->volume[$i],
                'nilai' => $request->nilai[$i],
            ];
            LaporanPelaksanaanEkspor::create($data);
        }

        return redirect()->route('qc.laporan_pelaksanaan_ekspor.index')->with('success', 'Laporan berhasil ditambahkan.');
    }

    public function print()
    {
        $data = [
            'title' => 'Laporan Pelaksanaan Ekspor Sarang Burung Walet',
            'laporan' => LaporanPelaksanaanEkspor::all(),
        ];
        return view('qc.laporan-pelaksanaan-ekspor.print', $data);
    }
}

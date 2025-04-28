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
}

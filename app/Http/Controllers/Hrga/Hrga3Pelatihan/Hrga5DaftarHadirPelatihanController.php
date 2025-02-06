<?php

namespace App\Http\Controllers\Hrga\Hrga3Pelatihan;

use App\Http\Controllers\Controller;
use App\Models\JadwalInformasiPelatihan;
use Illuminate\Http\Request;

class Hrga5DaftarHadirPelatihanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Hadir Pelatihan',
            'jadwal' => JadwalInformasiPelatihan::groupBy('nota_pelatihan')->get(),
        ];
        return view('hrga.hrga3.hrga5daftarhadirpelatihan.index', $data);
    }

    public function print(Request $r)
    {
        $data = [
            'title' => 'Daftar Hadir Pelatihan',
            'jadwal' => JadwalInformasiPelatihan::where('nota_pelatihan', $r->nota_pelatihan)->first(),
            'jadwal_detail' => JadwalInformasiPelatihan::where('nota_pelatihan', $r->nota_pelatihan)->get(),
        ];
        return view('hrga.hrga3.hrga5daftarhadirpelatihan.print', $data);
    }
}

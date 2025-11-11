<?php

namespace App\Http\Controllers\Hrga\Hrga3Pelatihan;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\JadwalInformasiPelatihan;
use Illuminate\Http\Request;

class Hrga4JadwalDanInformasiPelatihan extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Jadwal Dan Informasi Pelatihan',
            'jadwal' => JadwalInformasiPelatihan::groupBy('nota_pelatihan')->get(),
            'divisi' => Divisi::all(),
        ];
        return view('hrga.hrga3.hrga4jadwaldaninformasipelatihan.index', $data);
    }

    public function store(Request $r)
    {
        $nota_terakhir = JadwalInformasiPelatihan::orderBy('nota_pelatihan', 'desc')->first();
        $nota = empty($nota_terakhir->nota_pelatihan) ? 1 : $nota_terakhir->nota_pelatihan + 1;
        for ($i = 0; $i < count($r->id_pegawai); $i++) {
            $data = [
                'nota_pelatihan' => $nota,
                'tema_pelatihan' => $r->tema_pelatihan,
                'tanggal' => $r->tanggal,
                'waktu' => $r->waktu,
                'tempat' => $r->tempat,
                'narasumber' => $r->narasumber,
                'kisaran_materi' => $r->kisaran_materi,
                'penyelenggara' => $r->penyelenggara,
                'data_pegawais_id' => $r->id_pegawai[$i],
                'konfirmasi_keterangan' => 'Hadir'
            ];
            JadwalInformasiPelatihan::insert($data);
        }
        return redirect()->route('hrga3.4.index')->with('sukses', 'Data berhasil disimpan');
    }

    public function print(Request $r)
    {
        $data = [
            'title' => 'JADWAL & INFORMASI PELATIHAN',
            'dok' => 'Dok.No.: FRM.HRGA.03.04, Rev.00',
            'jadwal' => JadwalInformasiPelatihan::where('nota_pelatihan', $r->nota_pelatihan)->first(),
            'jadwal_detail' => JadwalInformasiPelatihan::where('nota_pelatihan', $r->nota_pelatihan)->get(),
            'divisi' => Divisi::all(),
        ];
        return view('hrga.hrga3.hrga4jadwaldaninformasipelatihan.print', $data);
    }
}

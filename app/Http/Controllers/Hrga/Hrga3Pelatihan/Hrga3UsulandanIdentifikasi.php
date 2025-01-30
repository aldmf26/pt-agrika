<?php

namespace App\Http\Controllers\Hrga\Hrga3Pelatihan;

use App\Http\Controllers\Controller;
use App\Models\DataPegawai;
use App\Models\Divisi;
use App\Models\usulanDanIdentifikasi;
use Illuminate\Http\Request;

class Hrga3UsulandanIdentifikasi extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Usulan dan Identifikasi kebutuhan pelatihan',
            'usulan' => usulanDanIdentifikasi::all(),
            'divisi' => Divisi::all(),
        ];
        return view('hrga.hrga3.hrga3usulandanidentifikasi.index', $data);
    }

    public function getPegawai(Request $r)
    {
        $pegawai = DataPegawai::where('divisi_id', $r->divisi)->get();
        return view('hrga.hrga3.hrga3usulandanidentifikasi.getpegawai', compact('pegawai'));
    }

    public function store(Request $r)
    {
        for ($i = 0; $i < count($r->id_pegawai); $i++) {
            $data = [
                'divisi_id' => $r->divisi,
                'data_pegawais_id' => $r->id_pegawai[$i],
                'pengusul' => $r->pengusul,
                'tanggal' => $r->tanggal,
                'usulan_jenis_pelatihan' => $r->usulan_jenis_pelatihan,
                'usulan_waktu' => $r->usulan_waktu,
                'alasan' => $r->alasan
            ];
            usulanDanIdentifikasi::insert($data);
        }

        return redirect()->route('hrga3.3.index')->with('sukses', 'Data Berhasil Disimpan');
    }

    public function print(Request $r)
    {
        $data = [
            'title' => 'Usulan dan Identifikasi kebutuhan pelatihan',
            'usulan' => usulanDanIdentifikasi::where('divisi_id', $r->divisi)->where('tanggal', $r->tanggal)->get(),
            'divisi' => Divisi::where('id', $r->divisi)->first(),
            'tanggal' => $r->tanggal
        ];
        return view('hrga.hrga3.hrga3usulandanidentifikasi.print', $data);
    }
}

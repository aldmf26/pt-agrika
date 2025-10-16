<?php

namespace App\Http\Controllers\Hrga\Hrga3Pelatihan;

use App\Http\Controllers\Controller;
use App\Models\DataPegawai;
use App\Models\Divisi;
use App\Models\JadwalInformasiPelatihan;
use App\Models\ProgramPelatihanTahunan;
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
        ProgramPelatihanTahunan::where('id', $r->Getid)->update([
            'isi_usulan' => 'Y'
        ]);

        $program = ProgramPelatihanTahunan::where('id', $r->Getid)->first();
        $nota_terakhir = JadwalInformasiPelatihan::orderBy('nota_pelatihan', 'desc')->first();
        $nota = empty($nota_terakhir->nota_pelatihan) ? 1 : $nota_terakhir->nota_pelatihan + 1;
        for ($i = 0; $i < count($r->id_pegawai); $i++) {
            $data = [
                'divisi_id' => 0,
                'data_pegawais_id' => $r->id_pegawai[$i],
                'pengusul' => $r->pengusul,
                'tanggal' => $r->tanggal,
                'usulan_jenis_pelatihan' => $r->usulan_jenis_pelatihan,
                'usulan_waktu' => $r->usulan_waktu,
                'alasan' => $r->alasan
            ];
            usulanDanIdentifikasi::insert($data);


            $data = [
                'nota_pelatihan' => $nota,
                'tema_pelatihan' => $r->usulan_jenis_pelatihan,
                'tanggal' => $r->tanggal,
                'waktu' => $r->usulan_waktu,
                'tempat' => "Ruang meeting lantai 2",
                'narasumber' => $program->narasumber,
                'kisaran_materi' => $r->alasan,
                'penyelenggara' => $program->sumber,
                'data_pegawais_id' => $r->id_pegawai[$i],
                'konfirmasi_keterangan' => 'Hadir'
            ];
            JadwalInformasiPelatihan::insert($data);
        }

        return redirect()->route('hrga3.2.index')->with('sukses', 'Data Berhasil Disimpan');
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

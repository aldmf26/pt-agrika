<?php

namespace App\Http\Controllers\Hrga\Hrga3Pelatihan;

use App\Http\Controllers\Controller;
use App\Models\InformasiTawaranPelatihan;
use Illuminate\Http\Request;

class Hrga1InformasiTawaranPelatihan extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Informasi Tawaran Pelatihan',
            'informasi' => InformasiTawaranPelatihan::orderBy('id', 'desc')->get(),
        ];
        return view('hrga.hrga3.hrga1informasitawaranpelatihan.index', $data);
    }

    public function store(Request $r)
    {
        $r->validate([
            'tanggal' => 'required',
            'jenis' => 'required',
            'sasaran' => 'required',
            'tema' => 'required',
            'sumber_informasi' => 'required',
            'personil_penghubung' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
        ]);
        InformasiTawaranPelatihan::create($r->all());

        return redirect()->back()->with('sukses', 'Data berhasil ditambahkan');
    }

    public function print(Request $r)
    {
        $tgl1 = $r->tgl1;
        $tgl2 = $r->tgl2;
        $data = [
            'title' => 'Informasi Tawaran Pelatihan',
            'informasi' => InformasiTawaranPelatihan::whereBetween('tanggal', [$tgl1, $tgl2])->orderBy('id', 'desc')->get(),
        ];
        return view('hrga.hrga3.hrga1informasitawaranpelatihan.print', $data);
    }
}

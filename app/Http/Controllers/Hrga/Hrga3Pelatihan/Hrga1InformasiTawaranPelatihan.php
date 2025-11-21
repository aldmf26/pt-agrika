<?php

namespace App\Http\Controllers\Hrga\Hrga3Pelatihan;

use App\Http\Controllers\Controller;
use App\Models\InformasiTawaranPelatihan;
use App\Models\ProgramPelatihanTahunan;
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

        $data = [
            'materi_pelatihan' => $r->tema,
            'sumber' => 'eksternal',
            'narasumber' => '-',
            'sasaran_peserta' => $r->sasaran,
            'tgl_rencana' => $r->tanggal,
            'tgl_realisasi' => $r->tanggal,
        ];
        ProgramPelatihanTahunan::create($data);

        return redirect()->back()->with('sukses', 'Data berhasil ditambahkan');
    }

    public function update(Request $r)
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

        $data = InformasiTawaranPelatihan::findOrFail($r->id);

        $data->update([
            'tanggal' => $r->tanggal,
            'jenis' => $r->jenis,
            'sasaran' => $r->sasaran,
            'tema' => $r->tema,
            'sumber_informasi' => $r->sumber_informasi,
            'personil_penghubung' => $r->personil_penghubung,
            'no_telp' => $r->no_telp,
            'email' => $r->email,
        ]);

        return redirect()->back()->with('sukses', 'Data berhasil diperbarui');
    }


    public function print(Request $r)
    {
        $tgl1 = $r->tgl1;
        $tgl2 = $r->tgl2;
        $data = [
            'title' => 'INFORMASI TAWARAN / POTENSI PELATIHAN',
            'dok' => 'Dok.No.: FRM.HRGA.03.01, Rev.00',
            'informasi' => InformasiTawaranPelatihan::whereBetween('tanggal', [$tgl1, $tgl2])->orderBy('id', 'asc')->get(),
        ];
        return view('hrga.hrga3.hrga1informasitawaranpelatihan.print', $data);
    }

    public function destroy($id)
    {
        InformasiTawaranPelatihan::destroy($id);
        return redirect()->back()->with('sukses', 'Data berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use App\Models\DataPegawai;
use App\Models\PenyucianNitrit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Pro4FormPenyucianNitrit extends Controller
{
    public function index(Request $r)
    {
        $id_pengawas = auth()->user()->id;
        $anak = Http::get("https://sarang.ptagafood.com/api/apihasap/tb_anak?id_pengawas=$id_pengawas");
        $anak = json_decode($anak, TRUE);


        $data = [
            'title' => 'CCP 1 Penyucian Nitrit',
            'pencucian' => PenyucianNitrit::where('nama_operator', auth()->user()->name)->groupBy('tanggal')->get(),
            'pegawai' => DataPegawai::where('divisi_id', 1)->get(),
            'anak' => $anak['data'],

        ];
        return view('produksi.pro4formpenyuciannitrit.index', $data);
    }

    public function store(Request $r)
    {
        for ($i = 0; $i < count($r->pegawai_id); $i++) {
            $data = [
                'tanggal' => $r->tanggal,
                'nama_operator' => $r->nama_operator,
                'start' => $r->start,
                'end' => $r->end,
                'waktu_penyucian' => $r->waktu_penyucian,
                'pegawai_id' => $r->pegawai_id[$i],
                'no_box' => $r->no_box[$i],
                'pcs' => $r->pcs[$i],
                'gr' => 0,
                'ket' => 'Penyucian Nitrit',
            ];
            PenyucianNitrit::create($data);
        }

        return redirect()->back()->with('sukses', 'Data berhasil disimpan');
    }

    public function print(Request $r)
    {
        $data = [
            'title' => 'CCP 1 Penyucian Nitrit',
            'pencucian' => PenyucianNitrit::where('tanggal', $r->tgl)->get(),
            'pegawai' => DataPegawai::where('divisi_id', 1)->get(),
            'tgl' => $r->tgl,
        ];
        return view('produksi.pro4formpenyuciannitrit.print', $data);
    }
}

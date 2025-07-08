<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use App\Models\DataPegawai;
use App\Models\Pengeringan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Pro5FormPengeringan extends Controller
{
    public function index(Request $r)
    {
        $posisi = auth()->user()->posisi_id;

        if ($posisi == 1) {
            $cabut = Http::get("https://sarang.ptagafood.com/api/apihasap/cabut");
            $cabut = json_decode($cabut, TRUE);
        } else {
            $id_pengawas = auth()->user()->id;

            $cabut = Http::get("https://sarang.ptagafood.com/api/apihasap/cabut?id_pengawas=$id_pengawas");
            $cabut = json_decode($cabut, TRUE);
        }

        $data = [
            'title' => 'Form pengeringan',
            'cabut' => $cabut['data'],
            'pegawai' => DataPegawai::where('divisi_id', 1)->get(),

        ];
        return view('produksi.pro5formpengeringan.index', $data);
    }

    public function store(Request $r)
    {

        for ($i = 0; $i < count($r->pegawai_id); $i++) {
            Pengeringan::create([
                'pegawai_id' => $r->pegawai_id[$i],
                'no_box' => $r->no_box[$i],
                'grade' => $r->grade[$i],
                'pcs' => $r->pcs[$i],
                'gr' => $r->gr[$i],
                'pcs_akhir' => $r->pcs_akhir[$i],
                'gr_akhir' => $r->gr_akhir[$i],
                'hcr' => $r->hcr[$i],
                'ket' => $r->ket[$i],
                'tanggal' => $r->tanggal,
                'pengawas' => $r->pengawas
            ]);
        }


        return redirect()->route('produksi.5.index')->with('sukses', 'Data berhasil ditambahkan');
    }

    public function print(Request $r)
    {

        $cabut = Http::get("https://sarang.ptagafood.com/api/apihasap/cabut_detail?tgl=$r->tgl&id_pengawas=$r->id_pengawas");
        $cabut = json_decode($cabut, TRUE);
        $data = [
            'title' => 'Form Pengeringan',
            'cabut' => $cabut['data'],
            'tgl' => $r->tgl,
            'pengawas' => $r->pengawas
        ];
        return view('produksi.pro5formpengeringan.print', $data);
    }
}

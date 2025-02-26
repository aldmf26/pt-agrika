<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use App\Models\DataPegawai;
use App\Models\Pengeringan;
use Illuminate\Http\Request;

class Pro5FormPengeringan extends Controller
{
    public function index(Request $r)
    {
        if (empty($r->tgl)) {
            $tgl = date('Y-m-d');
        } else {
            $tgl = $r->tgl;
        }
        $data = [
            'title' => 'Form Pengeringan',
            'pengeringan' => Pengeringan::where('tanggal', $tgl)->get(),
            'pegawai' => DataPegawai::where('divisi_id', 1)->get(),
            'tgl' => $tgl,
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
        if (empty($r->tgl)) {
            $tgl = date('Y-m-d');
        } else {
            $tgl = $r->tgl;
        }
        $data = [
            'title' => 'Form Pengeringan',
            'pengeringan' => Pengeringan::where('tanggal', $tgl)->get(),
            'pegawai' => DataPegawai::where('divisi_id', 1)->get(),
            'tgl' => $tgl,
        ];
        return view('produksi.pro5formpengeringan.print', $data);
    }
}

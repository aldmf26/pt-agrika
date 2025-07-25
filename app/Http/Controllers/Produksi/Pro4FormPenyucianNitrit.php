<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use App\Models\DataPegawai;
use App\Models\PenyucianNitrit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Pro4FormPenyucianNitrit extends Controller
{
    public function index(Request $r)
    {
        $cabut = Http::get("https://sarang.ptagafood.com/api/apihasap/cuci_nitrit");
        $cabut = json_decode($cabut, TRUE);
        $data = [
            'title' => 'Form Pencucian Nitrit',
            'cabut' => $cabut['data'],
        ];
        return view('produksi.pro4formpenyuciannitrit.index', $data);
    }

    public function store(Request $r)
    {
        for ($i = 0; $i < count($r->pegawai_id); $i++) {

            $box = $r->no_box[$i];
            $no_box = Http::get("https://sarang.ptagafood.com/api/apihasap/detail_box?no_box=$box");
            $no_box = json_decode($no_box, TRUE);

            $nm_partai = $no_box['data']['nm_partai'];



            $startTime = Carbon::createFromFormat('H:i', $r->start); // pastikan formatnya H:i
            $pcs = (int) $r->pcs[$i];
            $endTime = $startTime->copy()->addMinutes($pcs); // tambahkan sesuai jumlah pcs
            $data = [
                'tanggal' => $r->tanggal,
                'nama_operator' => $r->nama_operator,
                'start' => $r->start,
                'end' =>  $endTime->format('H:i'),
                'waktu_penyucian' => $r->waktu_penyucian,
                'pegawai_id' => $r->pegawai_id[$i],
                'no_box' => $r->no_box[$i],
                'nm_partai' => $nm_partai,
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
        $pencucian = Http::get("https://sarang.ptagafood.com/api/apihasap/nitrit_detail?id_pengawas=$r->id_pengawas&tgl=$r->tgl");
        $pencucian = json_decode($pencucian, TRUE);

        $data = [

            'title' => 'CCP 1 Penyucian Nitrit',
            'pencucian' => $pencucian['data'],
            'tgl' => $r->tgl,
            'nama_regu' => $r->pengawas
        ];
        return view('produksi.pro4formpenyuciannitrit.print2', $data);
    }
}

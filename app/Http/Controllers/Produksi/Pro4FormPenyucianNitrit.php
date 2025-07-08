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
        $id_pengawas = auth()->user()->id;
        $anak = Http::get("https://sarang.ptagafood.com/api/apihasap/tb_anak?id_pengawas=$id_pengawas");
        $anak = json_decode($anak, TRUE);
        $no_box = Http::get("https://sarang.ptagafood.com/api/apihasap/no_box?id_pengawas=$id_pengawas");
        $no_box = json_decode($no_box, TRUE);

        $pencucian = PenyucianNitrit::select(
            'tanggal',
            'nama_operator',
            DB::raw('SUM(pcs) as total_pcs'),
            DB::raw('COUNT(*) as jumlah_data')
        )
            ->where('nama_operator', auth()->user()->name)
            ->groupBy('tanggal')
            ->get();
        $data = [
            'title' => 'CCP 1 Penyucian Nitrit',
            'pencucian' => $pencucian,
            'pegawai' => DataPegawai::where('divisi_id', 1)->get(),
            'anak' => $anak['data'],
            'no_box' => $no_box['data'],

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
        $data = [
            'title' => 'CCP 1 Penyucian Nitrit',
            'pencucian' => PenyucianNitrit::where('tanggal', $r->tgl)->where('nama_operator', $r->nama_regu)->get(),
            'pegawai' => DataPegawai::where('divisi_id', 1)->get(),
            'tgl' => $r->tgl,
            'nama_regu' => $r->nama_regu
        ];
        return view('produksi.pro4formpenyuciannitrit.print', $data);
    }
}

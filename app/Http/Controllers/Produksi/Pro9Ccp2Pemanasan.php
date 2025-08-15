<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use App\Models\PemanasanCpp2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Pro9Ccp2Pemanasan extends Controller
{
    public function index(Request $r)
    {
        $pemanasan = Http::get("https://sarang.ptagafood.com/api/apihasap/steaming_baru");
        $pemanasan = json_decode($pemanasan, TRUE);
        $data = [
            'title' => 'Form pemanasan CCP 2',
            'pemanasan' => $pemanasan['data'],
        ];
        return view('produksi.pro9ccp2pemanasan.index', $data);
    }

    public function store(Request $r)
    {
        $data = [
            'tanggal' => $r->tanggal,
            'suhu_sarang_walet_awal' => $r->suhu_sarang_walet_awal,
            'suhu_ruang' => $r->suhu_ruang,
            'penambahan_air' => $r->penambahan_air,
            'mesin_pemanasan' => $r->mesin_pemanasan,
        ];
        DB::table('ruangans')->insert($data);

        for ($i = 0; $i < count($r->tray); $i++) {
            $data2 = [
                'tanggal' => $r->tanggal,
                'tray' => $r->tray[$i],
                'kode_batch' => $r->kode_batch[$i],
                'jenis' => $r->jenis[$i],
                'pcs' => $r->pcs[$i],
                'gr' => $r->gr[$i],
                'tventing_c' => $r->tventing_c[$i],
                'tventing_mnt' => $r->tventing_mnt[$i],
                'ttot_c' => $r->ttot_c[$i],
                'ttot_mnt' => $r->ttot_mnt[$i],
                'keterangan' => $r->keterangan[$i],
            ];
            PemanasanCpp2::create($data2);
        }

        return redirect()->route('produksi.9.index')->with('sukses', 'Data berhasil disimpan');
    }

    public function print(Request $r)
    {
        $tgl = $r->tgl;
        $pemanasan = Http::get("https://sarang.ptagafood.com/api/apihasap/coba_steaming?tgl=$tgl");
        $pemanasan = json_decode($pemanasan, TRUE);
        $data = [
            'title' => 'Form pemanasan CCP 2',
            'pemanasan' => $pemanasan['data'],
            'tgl' => $tgl,

        ];
        return view('produksi.pro9ccp2pemanasan.print', $data);
    }
}

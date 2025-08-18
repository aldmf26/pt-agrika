<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use App\Models\PemanasanCpp2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

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
        DB::table('header_ccp2')->where('tgl', $r->tgl)->delete();
        $data = [
            'tgl' => $r->tgl,
            'suhu_sbw_awal' => $r->suhu_sbw_awal,
            'suhu_ruang' => $r->suhu_ruang
        ];
        DB::table('header_ccp2')->insert($data);


        DB::table('isi_ccp2')->where('tgl', $r->tgl)->delete();
        for ($i = 0; $i < count($r->urutan); $i++) {
            $data = [
                'tgl' => $r->tgl,
                'waktu_mulai' => $r->waktu_mulai[$i],
                'urutan' => $r->urutan[$i],
                'tventing_c' => $r->tventing_c[$i],
                'tventing_menit' => $r->tventing_menit[$i],
                'tventing_detik' => $r->tventing_detik[$i],
                'ttot_c' => $r->ttot_c[$i],
                'ttot_menit' => $r->ttot_menit[$i],
                'ttot_detik' => $r->ttot_detik[$i],
            ];
            DB::table('isi_ccp2')->insert($data);
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
            'header' => DB::table('header_ccp2')->where('tgl', $r->tgl)->first()

        ];
        return view('produksi.pro9ccp2pemanasan.print', $data);
    }

    public function get_edit(Request $r)
    {
        $header = DB::table('header_ccp2')->where('tgl', $r->tgl)->first();


        $total = $r->gr;
        $perUrutan = 6000;
        $urutanPenuh = intdiv($total, $perUrutan);
        $sisa = $total % $perUrutan;
        $totalUrutan = $urutanPenuh + ($sisa > 0 ? 1 : 0);

        $data = [
            'header' => $header,

            'totalUrutan' => $totalUrutan,
            'tgl' => $r->tgl
        ];
        return view('produksi.pro9ccp2pemanasan.edit', $data);
    }
}

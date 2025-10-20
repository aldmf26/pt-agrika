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
        $tgl = $r->tgl;

        // Ambil header
        $header = DB::table('header_ccp2')->where('tgl', $tgl)->first();

        // Ambil data API
        $response = Http::get("https://sarang.ptagafood.com/api/apihasap/coba_steaming?tgl=$tgl");
        if ($response->failed()) {
            return back()->with('error', 'Gagal mengambil data API.');
        }

        $pemanasan = json_decode($response->body(), true);
        if (!isset($pemanasan['data']) || empty($pemanasan['data'])) {
            return back()->with('error', 'Data kosong.');
        }

        $dataApi = collect($pemanasan['data']);
        $grouped = $dataApi->groupBy('kelompok');

        $trayDetail = [];
        $urutan = 1;

        foreach ($grouped as $kelompok => $items) {
            $totalBaris = count($items);
            $jumlahTrayKelompok = ceil($totalBaris / 6); // misal 13 data => 3 urutan

            for ($i = 1; $i <= $jumlahTrayKelompok; $i++) {
                $trayDetail[] = [
                    'urutan' => $urutan,
                    'kelompok' => $kelompok,
                    'tray_ke' => $i,
                    'total_baris_kelompok' => $totalBaris,
                    'total_tray_kelompok' => $jumlahTrayKelompok,
                ];
                $urutan++;
            }
        }

        return view('produksi.pro9ccp2pemanasan.edit', [
            'header' => $header,
            'tgl' => $tgl,
            'detailTray' => $trayDetail,
            'totalUrutan' => count($trayDetail),
        ]);
    }
}

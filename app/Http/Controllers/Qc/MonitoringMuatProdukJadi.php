<?php

namespace App\Http\Controllers\Qc;

use App\Http\Controllers\Controller;
use App\Models\MonitorMuatProdukJadi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MonitoringMuatProdukJadi extends Controller
{
    public function index(Request $r)
    {
        $bk = Http::get("https://sarang.ptagafood.com/api/apihasap/monitoringProdukJadi");
        $bk = json_decode($bk, TRUE);

        foreach ($bk['data'] as $v) {
            $monitor = MonitorMuatProdukJadi::where('kode_produk', $v['no_box'])->first();
            if (empty($monitor->kode_produk)) {
                $data = [
                    'tgl_masuk' => $v['tgl_input'],
                    'tgl_keluar' => date('Y-m-d', strtotime($v['tgl_input'] . ' +1 day')),
                    'kode_produk' => $v['no_box'],
                    'nm_produk' => $v['grade'],
                    'kg' => $v['gr'],
                ];
                MonitorMuatProdukJadi::create($data);
            } else {
                $data = [
                    'tgl_masuk' => $v['tgl_input'],
                    'kode_produk' => $v['no_box'],
                    'nm_produk' => $v['grade'],
                    'kg' => $v['gr'],
                ];
                MonitorMuatProdukJadi::where('kode_produk', $v['no_box'])->update($data);
            }
        }

        $data = [
            'title' => 'Monitoring muat produk jadi',
            'datas' => MonitorMuatProdukJadi::orderBy('tgl_masuk', 'desc')->get(),
        ];
        return view('qc.monitoring_muat_produk_jadi.index', $data);
    }

    public function print()
    {
        $data = [
            'title' => 'Monitoring muat produk jadi',
            'datas' => MonitorMuatProdukJadi::orderBy('tgl_masuk', 'desc')->get(),
        ];
        return view('qc.monitoring_muat_produk_jadi.print', $data);
    }
}

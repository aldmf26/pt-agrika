<?php

namespace App\Http\Controllers\Qc;

use App\Http\Controllers\Controller;
use App\Models\PemriksaanRetail;
use Illuminate\Http\Request;

class PemeriksaanRetail extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Pemeriksaan Retail',
            'datas' => PemriksaanRetail::groupBy(['retain_sampel', 'tgl'])->orderBy('id', 'desc')->get()
        ];

        return view('qc.pemeriksaan_retail.index', $data);
    }
    public function print(Request $r)
    {
        $data = [
            'title' => 'Pemeriksaan Retail',
            'head' => PemriksaanRetail::where('retain_sampel', $r->retain_sampel)->where('tgl', $r->tgl)->first(),
            'datas' => PemriksaanRetail::where('retain_sampel', $r->retain_sampel)->where('tgl', $r->tgl)->get(),
            'bulan' => ['6', '12', '18', '24']
        ];

        return view('qc.pemeriksaan_retail.print', $data);
    }

    public function store(Request $r)
    {
        $count = count($r->production_date); // total baris input

        for ($i = 0; $i < $count; $i++) {
            $data = [
                'retain_sampel' => $r->retain_sampel,
                'tgl' => $r->tgl,
                'standar_kebutuhan' => $r->standar_kebutuhan,
                'production_date' => $r->production_date[$i],
                'expired_date' => $r->expired_date[$i],
                'warna' => $r->input("warna_$i"),
                'bau' => $r->input("bau_$i"),
                'tekstur' => $r->input("tekstur_$i"),
                'kandungan_nitrit' => $r->kandungan_nitrit[$i],
                'keterangan' => $r->keterangan[$i],
            ];

            PemriksaanRetail::create($data);
        }

        return redirect()->route('qc.pemeriksaan_retail.index')->with('sukses', 'Data Berhasil Disimpan');
    }
}

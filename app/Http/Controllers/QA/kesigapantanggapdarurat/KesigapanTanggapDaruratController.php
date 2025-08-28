<?php

namespace App\Http\Controllers\qa\kesigapantanggapdarurat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KesigapanTanggapDaruratController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Laporan Kesigapan Dan Tanggap Darurat',
            'kesigapan' => DB::table('kesigapan_tanggap_darurat')->orderBy('id', 'desc')->get(),

        ];
        return view('qa.kesigapantanggapdarurat.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Kesigapan Dan Tanggap Darurat',
            'lokasi' => DB::table('lokasi')->get(),
        ];
        return view('qa.kesigapantanggapdarurat.create', $data);
    }

    public function store(Request $request)
    {
        $detailID = DB::table('kesigapan_tanggap_darurat')->insertGetId(
            [
                'tgl' => $request->tgl,
                'jenis_insiden' => $request->jenis_insiden,
                'lokasi' => $request->lokasi1,
                'penyebab' => $request->penyebab,
                'akibat' => $request->akibat,
                'dari_jam' => $request->dari_jam,
                'sampai_jam' => $request->sampai_jam,
                'kejadian' => $request->kejadian,
            ]
        );

        for ($i = 0; $i < count($request->lokasi2); $i++) {
            $data = [
                'kesigapan_id' => $detailID,
                'lokasi' => $request->lokasi2[$i],
                'cedera' => $request->cedera[$i],
                'meninggal' => $request->meninggal[$i],
                'infrastruktur' => $request->infrastruktur[$i],
                'produk' => $request->produk[$i],
                'potensi_bahaya' => $request->potensi_bahaya[$i],
                'tindakan' => $request->tindakan[$i],
                'pic' => $request->pic[$i],
            ];
            DB::table('detail_kesigapan_tanggap_darurat')->insert($data);
        }

        return redirect(route('qa.kesigapan.1.index'))->with('sukses', 'Data Berhasil Disimpan');
    }

    public function edit(Request $r)
    {
        $data = [
            'title' => 'Edit Data Kesigapan Dan Tanggap Darurat',
            'lokasi' => DB::table('lokasi')->get(),
            'kesigapan' => DB::table('kesigapan_tanggap_darurat')->where('id', $r->id)->first(),
            'detail' => DB::table('detail_kesigapan_tanggap_darurat')->where('kesigapan_id', $r->id)->get(),
        ];
        return view('qa.kesigapantanggapdarurat.edit', $data);
    }

    public function update(Request $request)
    {

        DB::table('kesigapan_tanggap_darurat')->where('id', $request->id)->update(
            [
                'tgl' => $request->tgl,
                'jenis_insiden' => $request->jenis_insiden,
                'lokasi' => $request->lokasi1,
                'penyebab' => $request->penyebab,
                'akibat' => $request->akibat,
                'dari_jam' => $request->dari_jam,
                'sampai_jam' => $request->sampai_jam,
                'kejadian' => $request->kejadian,
            ]
        );



        DB::table('detail_kesigapan_tanggap_darurat')->where('kesigapan_id', $request->id)->delete();
        for ($i = 0; $i < count($request->lokasi2); $i++) {
            $data = [
                'kesigapan_id' => $request->id,
                'lokasi' => $request->lokasi2[$i],
                'cedera' => $request->cedera[$i],
                'meninggal' => $request->meninggal[$i],
                'infrastruktur' => $request->infrastruktur[$i],
                'produk' => $request->produk[$i],
                'potensi_bahaya' => $request->potensi_bahaya[$i],
                'tindakan' => $request->tindakan[$i],
                'pic' => $request->pic[$i],
            ];
            DB::table('detail_kesigapan_tanggap_darurat')->insert($data);
        }

        return redirect(route('qa.kesigapan.1.index'))->with('sukses', 'Data Berhasil Disimpan');
    }

    public function print(Request $r)
    {
        $data = [
            'title' => 'Print Data Kesigapan Dan Tanggap Darurat',
            'kesigapan' => DB::table('kesigapan_tanggap_darurat')->where('id', $r->id)->first(),
            'detail' => DB::table('detail_kesigapan_tanggap_darurat')->where('kesigapan_id', $r->id)->get(),
        ];
        return view('qa.kesigapantanggapdarurat.print', $data);
    }
}

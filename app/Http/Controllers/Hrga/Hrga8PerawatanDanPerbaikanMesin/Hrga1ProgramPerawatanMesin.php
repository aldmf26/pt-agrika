<?php

namespace App\Http\Controllers\Hrga\Hrga8PerawatanDanPerbaikanMesin;

use App\Http\Controllers\Controller;
use App\Models\checklistPerawatanMesin;
use App\Models\ItemMesin;
use App\Models\ProgramPerawatanMesin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hrga1ProgramPerawatanMesin extends Controller
{
    public function index(Request $r)
    {
        if (empty($r->tahun)) {
            $tahun = date('Y');
        } else {
            $tahun = $r->tahun;
        }
        $kategori = $r->kategori ?? 'mesin';

        $data = [
            'title' => 'Program perawatan mesin',
            'bulan' => DB::table('bulan')->get(),
            'tahun' => $tahun,
            'item' => ItemMesin::where('kategori', $kategori)->get(),
            'perawatan' => ProgramPerawatanMesin::whereYear('tanggal_mulai', $tahun)
                ->whereHas('item', function ($query) use ($kategori) {
                    $query->where('kategori', $kategori);
                })
                ->orderBy('id', 'desc')
                ->get(),
            'kategori' => $kategori,

        ];
        return view('hrga.hrga8.hrga1_perawatan_dan_perbaikan_mesin.index', $data);
    }

    public function store(Request $r)
    {
        for ($i = 0; $i < count($r->item_mesin_id); $i++) {
            $data = [
                'item_mesin_id' => $r->item_mesin_id[$i],
                'frekuensi_perawatan' => $r->frekuensi_perawatan[$i],
                'penanggung_jawab' => $r->penanggung_jawab[$i],
                'tanggal_mulai' => $r->tanggal_mulai[$i],
            ];
            ProgramPerawatanMesin::create($data);

            $total = floor(12 / $r->frekuensi_perawatan[$i]);
            for ($j = 0; $j < $total; $j++) {

                $kriteria = DB::table('kriteria_pemeriksaan')->where('item_mesin_id', $r->item_mesin_id[$i])->get();
                $tgl = date('Y-m-d', strtotime($r->tanggal_mulai[$i] . ' + ' . ($j * $r->frekuensi_perawatan[$i]) . ' month'));
                foreach ($kriteria as $k) {
                    $data = [
                        'item_mesin_id' => $r->item_mesin_id[$i],
                        'kriteria_id' => $k->id,
                        'tgl' => $tgl,
                        'metode' => 'Visual',
                        'hasil_pemeriksaan' => 'Ok',
                        'status' => 'Tidak membutuhkan perbaikan, dapat digunakan kembali',
                    ];
                    checklistPerawatanMesin::create($data);
                }
            }
        }


        return redirect()->route('hrga8.1.index', ['kategori' => $r->kategori])->with('sukses', 'Data Berhasil Disimpan');
    }

    public function print(Request $r)
    {
        if (empty($r->tahun)) {
            $tahun = date('Y');
        } else {
            $tahun = $r->tahun;
        }
        $kategori = $r->kategori ?? 'mesin';
        $title = $kategori == 'mesin' ? 'PROGRAM PERAWATAN MESIN PROSES PRODUKSI' : 'PROGRAM PERAWATAN SOFTWARE & HARDWARE PROSES PRODUKSI';
        $no_dokumen = $kategori == 'mesin' ? 'Dok.No.: FRM.HRGA.08.01, Rev.00' : 'Dok.No.: FRM.IT.01.01, Rev.00';
        $data = [
            'title' => $title,
            'bulan' => DB::table('bulan')->get(),
            'no_dokumen' => $no_dokumen,
            'tahun' => $tahun,
            'item' => ItemMesin::where('kategori', $r->kategori)->get(),
            'perawatan' => ProgramPerawatanMesin::whereYear('tanggal_mulai', $tahun)
                ->whereHas('item', function ($query) use ($kategori) {
                    $query->where('kategori', $kategori);
                })
                ->orderBy('id', 'desc')
                ->get(),

        ];
        return view('hrga.hrga8.hrga1_perawatan_dan_perbaikan_mesin.print', $data);
    }

    public function load_baris(Request $r)
    {

        $item = ItemMesin::all();

        $data = [
            'item' => $item,

            'count' => $r->count
        ];
        return view('hrga.hrga8.hrga1_perawatan_dan_perbaikan_mesin.tambah_baris', $data);
    }
}

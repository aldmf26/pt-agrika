<?php

namespace App\Http\Controllers\Hrga\Hrga8PerawatanDanPerbaikanMesin;

use App\Http\Controllers\Controller;
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
        $data = [
            'title' => 'Program perawatan mesin',
            'bulan' => DB::table('bulan')->get(),
            'tahun' => $tahun,
            'item' => ItemMesin::all(),
            'perawatan' => ProgramPerawatanMesin::whereYear('tanggal_mulai', $tahun)->orderBy('id', 'desc')->get(),
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
        }

        return redirect()->route('hrga8.1.index')->with('sukses', 'Data Berhasil Disimpan');
    }

    public function print(Request $r)
    {
        if (empty($r->tahun)) {
            $tahun = date('Y');
        } else {
            $tahun = $r->tahun;
        }
        $data = [
            'title' => 'Program Perawatan Mesin',
            'bulan' => DB::table('bulan')->get(),
            'tahun' => $tahun,
            'item' => ItemMesin::all(),
            'perawatan' => ProgramPerawatanMesin::whereYear('tanggal_mulai', $tahun)->orderBy('id', 'desc')->get(),
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

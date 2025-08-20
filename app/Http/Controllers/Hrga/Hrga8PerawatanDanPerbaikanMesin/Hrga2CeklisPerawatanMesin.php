<?php

namespace App\Http\Controllers\Hrga\Hrga8PerawatanDanPerbaikanMesin;

use App\Http\Controllers\Controller;
use App\Models\checklistPerawatanMesin;
use App\Models\ItemMesin;
use App\Models\ProgramPerawatanMesin;
use Illuminate\Http\Request;

class Hrga2CeklisPerawatanMesin extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Checklist perawatan mesin',
            'checklist' => checklistPerawatanMesin::groupBy('item_mesin_id')->get(),
        ];
        return view('hrga.hrga8.hrga2_ceklist_perawatan_mesin.index', $data);
    }

    public function add(Request $r)
    {
        $data = [
            'title' => 'Tambah checklist perawatan mesin',
            'mesin' => ProgramPerawatanMesin::where('id', $r->id)->first(),
            'checklist' => checklistPerawatanMesin::where('perawatan_mesin_id', $r->id)->whereMonth('tgl', $r->bulan)->whereYear('tgl', $r->tahun)->orderBy('id', 'asc')->get(),
            'checklist2' => checklistPerawatanMesin::where('perawatan_mesin_id', $r->id)->whereMonth('tgl', $r->bulan)->whereYear('tgl', $r->tahun)->orderBy('id', 'asc')->first(),
            'bulan' => $r->bulan,
            'tahun' => $r->tahun,
            'id' => $r->id
        ];
        return view('hrga.hrga8.hrga2_ceklist_perawatan_mesin.add', $data);
    }

    public function store(Request $r)
    {
        $bulan = date('m', strtotime($r->tgl));
        $tahun = date('Y', strtotime($r->tgl));
        checklistPerawatanMesin::where('perawatan_mesin_id', $r->id)->whereMonth('tgl', $bulan)->whereYear('tgl', $tahun)->orderBy('id', 'asc')->delete();
        for ($i = 0; $i < count($r->kriteria_pemeriksaan); $i++) {
            $data = [
                'perawatan_mesin_id' => $r->id,
                'tgl' => $r->tgl,
                'kriteria_pemeriksaan' => $r->kriteria_pemeriksaan[$i],
                'metode' => $r->metode[$i],
                'hasil_pemeriksaan' => $r->hasil_pemeriksaan[$i],
                'status' => $r->status[$i],
                'keterangan' => $r->keterangan[$i],
            ];
            checklistPerawatanMesin::create($data);
        }

        return redirect()->route('hrga8.1.index')->with('sukses', 'Data Berhasil Disimpan');
    }

    public function print(Request $r)
    {
        $minDate = checklistPerawatanMesin::min('tgl');


        $data = [
            'title' => 'Checklist perawatan mesin',
            'mesin' => ItemMesin::where('id', $r->id)->first(),
            'perawatan' => ProgramPerawatanMesin::where('item_mesin_id', $r->id)
                ->latest()
                ->first(),

            'checklist' => checklistPerawatanMesin::where('item_mesin_id', $r->id)
                ->whereBetween('tgl', [$minDate, now()])
                ->orderBy('id', 'asc')
                ->get(),
            'checklist2' => checklistPerawatanMesin::where('item_mesin_id', $r->id)->whereMonth('tgl', $r->bulan)->whereYear('tgl', $r->tahun)->orderBy('id', 'asc')->first(),
            'bulan' => $r->bulan,
            'tahun' => $r->tahun,
            'id' => $r->id
        ];
        return view('hrga.hrga8.hrga2_ceklist_perawatan_mesin.print', $data);
    }
}

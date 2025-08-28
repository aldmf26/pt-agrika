<?php

namespace App\Http\Controllers\Hrga\Hrga9ProgramKalibrasi;

use App\Http\Controllers\Controller;
use App\Models\hrga9_1KalibrasiModel;
use App\Models\ItemKalibrasiModel;
use App\Models\JadwalKalibrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hrga1ProgramKalibrasi extends Controller
{
    public function index(Request $r)
    {

        $tahun = JadwalKalibrasi::selectRaw('YEAR(tanggal) as tahun')
            ->distinct()
            ->pluck('tahun')
            ->toArray();


        if (empty($r->tahun)) {
            $tahun = $tahun ? max($tahun) : date('Y');
        } else {
            $tahun = $r->tahun;
        }

        $data = [
            'title' => 'FRM.HRGA.09.01 - PROGRAM KALIBRASI SARANA PEMANTAUAN DAN PENGUKURAN',
            'bulan' => DB::table('bulan')->get(),
            'program' => hrga9_1KalibrasiModel::where('tahun', $tahun)->get(),
            'item' => ItemKalibrasiModel::all(),
            'tahun' => $tahun,
            'tahuns' => hrga9_1KalibrasiModel::select('tahun')->distinct()->pluck('tahun')->toArray()
        ];
        return view('hrga.hrga9.hrga1_programkalibrasi.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_kalibrasi_id' => 'required',
            'rentang' => 'required',
            'resolusi' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
        ]);
        hrga9_1KalibrasiModel::create($request->all());
        return redirect()->route('hrga9.1.index', ['tahun' => $request->tahun])->with('success', 'Data Berhasil Disimpan');
    }

    public function itemKalibrasi($id)
    {
        $item = ItemKalibrasiModel::with('lokasi')->find($id);


        return response()->json($item);
    }

    public function print(Request $r)
    {
        if (empty($r->tahun)) {
            $tahun = date('Y');
        } else {
            $tahun = $r->tahun;
        }
        $data = [
            'title' => 'FRM.HRGA.09.01 - PROGRAM KALIBRASI SARANA PEMANTAUAN DAN PENGUKURAN',
            'bulan' => DB::table('bulan')->get(),
            'program' => hrga9_1KalibrasiModel::where('tahun', $tahun)->get(),
            'item' => ItemKalibrasiModel::all(),
            'tahun' => $tahun,
            'tahuns' => hrga9_1KalibrasiModel::select('tahun')->distinct()->get(),
        ];
        return view('hrga.hrga9.hrga1_programkalibrasi.print', $data);
    }
}

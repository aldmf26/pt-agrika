<?php

namespace App\Http\Controllers\Hrga\Hrga9ProgramKalibrasi;

use App\Http\Controllers\Controller;
use App\Models\ItemKalibrasiModel;
use App\Models\LokasiModel;
use Illuminate\Http\Request;

class Hrga0ItemKalibrasi extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Item  Kalibrasi',
            'lokasi' => LokasiModel::all(),
            'item' => ItemKalibrasiModel::orderby('id', 'desc')->get(),

        ];
        return view('hrga.hrga9.daftaritemkalibrasi.index', $data);
    }
    public function store(Request $request)
    {

        $item_id = ItemKalibrasiModel::insertGetId([
            'lokasi_id' => $request->lokasi_id,
            'name' => $request->nama_item,
            'merk' => $request->merk,
            'nomor_seri' => $request->nomor_seri,

        ]);

        return redirect()->route('hrga9.0.index')->with('sukses', 'Data sarana dan prasarana berhasil disimpan.');
    }

    public function delete(Request $request)
    {
        $item = ItemKalibrasiModel::find($request->id);
        if ($item) {
            $item->delete();
            return redirect()->route('hrga9.0.index')->with('sukses', 'Data sarana dan prasarana berhasil dihapus.');
        } else {
            return redirect()->route('hrga9.0.index')->with('error', 'Data sarana dan prasarana gagal dihapus.');
        }
    }
}

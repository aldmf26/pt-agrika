<?php

namespace App\Http\Controllers\Hrga\Hrga8PerawatanDanPerbaikanMesin;

use App\Http\Controllers\Controller;
use App\Models\ItemMesin;
use App\Models\LokasiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class daftarMesinController extends Controller
{
    public function index(Request $r)
    {
        $kategori = $r->kategori ?? 'mesin';
        $title = $kategori == 'mesin' ? 'Daftar Mesin Proeses Produksi' : 'Daftar Item It';
        $data = [
            'title' => $title,
            'lokasi' => LokasiModel::all(),
            'item' => ItemMesin::where('kategori', $kategori)->orderby('id', 'desc')->get(),
            'kategori' => $kategori,

        ];
        return view('hrga.hrga8.daftarmesin.index', $data);
    }

    public function store(Request $request)
    {

        $item_id = ItemMesin::insertGetId([
            'lokasi_id' => $request->lokasi_id,
            'nama_mesin' => $request->nama_mesin,
            'jumlah' => $request->jumlah,
            'kategori' => $request->kategori,

        ]);

        for ($i = 0; $i < count($request->kriteria); $i++) {
            $data = [
                'item_mesin_id' => $item_id,
                'kriteria' => $request->kriteria[$i],
                'metode' => $request->metode[$i],
            ];
            DB::table('kriteria_pemeriksaan')->insert($data);
        }



        return redirect()->route('hrga8.0.index', ['kategori' => $request->kategori])->with('sukses', 'Data sarana dan prasarana berhasil disimpan.');
    }


    public function delete(Request $request)
    {
        $item = ItemMesin::find($request->id);

        if ($item) {
            $item->delete();
            return redirect()->route('hrga8.0.index')->with('sukses', 'Data mesin proses produksi berhasil dihapus.');
        } else {
            return redirect()->route('hrga8.0.index')->with('error', 'Data mesin proses produksi gagal dihapus.');
        }
    }

    public function get_data(Request $request)
    {
        $item = ItemMesin::find($request->id);

        $data = [
            'item' => $item,
            'kriteria' => DB::table('kriteria_pemeriksaan')
                ->where('item_mesin_id', $item->id)
                ->get(),
            'lokasi' => LokasiModel::all(),
        ];

        return view('hrga.hrga8.daftarmesin.edit', $data);
    }

    public function update(Request $request)
    {
        ItemMesin::where('id', $request->id)->update([
            'lokasi_id' => $request->lokasi_id,
            'nama_mesin' => $request->nama_mesin,
            'jumlah' => $request->jumlah,
            'kategori' => $request->kategori,

        ]);
        for ($i = 0; $i < count($request->kriteria); $i++) {
            if (empty($request->kriteria_id[$i])) {
                $data = [
                    'item_mesin_id' => $request->id,
                    'kriteria' => $request->kriteria[$i],
                    'metode' => $request->metode[$i],
                ];
                DB::table('kriteria_pemeriksaan')->insert($data);
            } else {
                $data = [
                    'item_mesin_id' => $request->id,
                    'kriteria' => $request->kriteria[$i],
                    'metode' => $request->metode[$i],
                ];
                DB::table('kriteria_pemeriksaan')->where('id', $request->kriteria_id[$i])->update($data);
            }
        }
        return redirect()->route('hrga8.0.index', ['kategori' => $request->kategori])->with('sukses', 'Data sarana dan prasarana berhasil diupdate.');
    }
}

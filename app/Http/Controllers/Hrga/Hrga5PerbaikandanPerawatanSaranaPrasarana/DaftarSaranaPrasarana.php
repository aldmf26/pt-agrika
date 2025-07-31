<?php

namespace App\Http\Controllers\Hrga\Hrga5PerbaikandanPerawatanSaranaPrasarana;

use App\Http\Controllers\Controller;
use App\Models\ItemPerawatan;
use App\Models\LokasiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarSaranaPrasarana extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Sarana dan Prasarana',
            'lokasi' => LokasiModel::all(),
            'item' => ItemPerawatan::orderby('id', 'desc')->get(),

        ];
        return view('hrga.hrga5.daftarsaranaprasarana.index', $data);
    }

    public function store(Request $request)
    {

        $item_id = ItemPerawatan::insertGetId([
            'lokasi_id' => $request->lokasi_id,
            'nama_item' => $request->nama_item,
            'no_identifikasi' => $request->no_identifikasi,
            'jumlah' => $request->jumlah,
            'jenis_item' => $request->jenis_item
        ]);

        if ($request->jenis_item == 'ruangan') {
            for ($i = 0; $i < count($request->rincian); $i++) {
                $data = [
                    'item_id' => $item_id,
                    'nama_rincian' => $request->rincian[$i],
                ];
                DB::table('rincian_ruangan')->insert($data);
            }
        }

        return redirect()->route('daftar.1.index')->with('sukses', 'Data sarana dan prasarana berhasil disimpan.');
    }

    public function delete(Request $request)
    {
        $item = ItemPerawatan::find($request->id);
        DB::table('rincian_ruangan')->where('item_id', $request->id)->delete();
        if ($item) {
            $item->delete();
            return redirect()->route('daftar.1.index')->with('sukses', 'Data sarana dan prasarana berhasil dihapus.');
        } else {
            return redirect()->route('daftar.1.index')->with('error', 'Data sarana dan prasarana gagal dihapus.');
        }
    }

    public function get_data(Request $request)
    {
        $item = ItemPerawatan::find($request->id);

        $data = [
            'item' => $item,
            'rincian' => DB::table('rincian_ruangan')
                ->where('item_id', $item->id)
                ->get(),
            'lokasi' => LokasiModel::all(),
        ];

        return view('hrga.hrga5.daftarsaranaprasarana.edit', $data);
    }


    public function update(Request $request)
    {

        ItemPerawatan::where('id', $request->id)->update([
            'lokasi_id' => $request->lokasi_id,
            'nama_item' => $request->nama_item,
            'no_identifikasi' => $request->no_identifikasi,
            'jumlah' => $request->jumlah,
            'jenis_item' => $request->jenis_item
        ]);

        if ($request->jenis_item == 'ruangan') {
            for ($i = 0; $i < count($request->rincian); $i++) {
                if (empty($request->rincian_id[$i])) {
                    $data = [
                        'item_id' => $request->id,
                        'nama_rincian' => $request->rincian[$i],
                    ];
                    DB::table('rincian_ruangan')->insert($data);
                } else {
                    $data = [
                        'item_id' => $request->id,
                        'nama_rincian' => $request->rincian[$i],
                    ];
                    DB::table('rincian_ruangan')->where('id', $request->rincian_id[$i])->update($data);
                }
            }
        }

        return redirect()->route('daftar.1.index')->with('sukses', 'Data sarana dan prasarana berhasil diupdate.');
    }
}

<?php

namespace App\Http\Controllers\Hrga\Hrga5PerbaikandanPerawatanSaranaPrasarana;

use App\Http\Controllers\Controller;
use App\Models\ItemPerawatan;
use App\Models\LokasiModel;
use App\Models\ProgramPerawatanSaranaPrasarana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hrga1ProgramPerawatanSaranadanPrasaranaUmum extends Controller
{
    public function index(Request $r)
    {
        if (empty($r->tahun)) {
            $tahun = date('Y');
        } else {
            $tahun = $r->tahun;
        }
        $data = [
            'title' => 'Program Perawatan Sarana dan Prasarana Umum',
            'lokasi' => LokasiModel::all(),
            'bulan' => DB::table('bulan')->get(),
            'tahun' => $tahun,
            'program' => ProgramPerawatanSaranaPrasarana::whereYear('tanggal_mulai', $tahun)->orderBy('id', 'desc')->get(),
        ];
        return view('hrga.hrga5.hrga1_programperawatansarana.index', $data);
    }

    public function get_item(Request $r)
    {
        $item = ItemPerawatan::where('lokasi_id', $r->id)->get();

        echo "<option value=''>Pilih Item</option>";
        foreach ($item as $key => $value) {
            $no_identifikasi =  empty($value->no_identifikasi) ? '' : "($value->no_identifikasi)";
            $nama =  $value->nama_item . ' ' . $value->merek . ' ' . $no_identifikasi;
            echo '<option value="' . $value->id . '">' . $nama . '</option>';
        }
    }

    public function get_merk(Request $r)
    {
        $item = ItemPerawatan::where('id', $r->id)->first();
        $data = [
            'merk' => $item->merek ?? 'kosong',
            'no_identifikasi' => $item->no_identifikasi ?? 'kosong',
        ];
        return response()->json($data);
    }

    public function store(Request $r)
    {
        $r->validate([
            'item_id' => 'required',
            'frekuensi_perawatan' => 'required',
            'penanggung_jawab' => 'required',
            'tanggal_mulai' => 'required',
        ]);

        ProgramPerawatanSaranaPrasarana::create($r->all());
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function print(Request $r)
    {
        $data = [
            'title' => 'Program Perawatan Sarana dan Prasarana Umum',
            'lokasi' => LokasiModel::all(),
            'bulan' => DB::table('bulan')->get(),
            'tahun' => $r->tahun,
            'program' => ProgramPerawatanSaranaPrasarana::whereYear('tanggal_mulai', $r->tahun)->orderBy('id', 'desc')->get(),
        ];
        return view('hrga.hrga5.hrga1_programperawatansarana.print', $data);
    }
}

<?php

namespace App\Http\Controllers\Hrga\Hrga5PerbaikandanPerawatanSaranaPrasarana;

use App\Http\Controllers\Controller;
use App\Models\ItemPerawatan;
use App\Models\LokasiModel;
use App\Models\PerawatanModel;
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
            'tahuns' => ProgramPerawatanSaranaPrasarana::selectRaw('YEAR(tanggal_mulai) as tahun')
                ->distinct()
                ->pluck('tahun')
                ->toArray()
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

    public function copy(Request $r)
    {
        $program = ProgramPerawatanSaranaPrasarana::find($r->id);

        $data = [
            'item_id' => $program->item_id,
            'frekuensi_perawatan' => $program->frekuensi_perawatan,
            'penanggung_jawab' => $program->penanggung_jawab,
            'tanggal_mulai' => date("Y-m-d", strtotime("+1 year", strtotime($program->tanggal_mulai))),
            'keterangan' => $program->keterangan,
        ];

        ProgramPerawatanSaranaPrasarana::create($data);

        $total = floor(12 / $program->frekuensi_perawatan);

        $tgl_mulai = date("Y-m-d", strtotime("+1 year", strtotime($program->tanggal_mulai)));
        for ($i = 0; $i < $total; $i++) {
            $tgl = date('Y-m-d', strtotime($tgl_mulai . ' + ' . ($i * $program->frekuensi_perawatan) . ' month'));
            $data = [
                'item_id' => $program->item_id,
                'tgl' => $tgl,
                'kesimpulan' => 'kondisi masih bagus',
                'fungsi' => 'bagus',
            ];
            PerawatanModel::create($data);
        }

        return redirect()->back()->with('success', 'Data berhasil disalin');
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

        $item = ItemPerawatan::find($r->item_id);

        $total = floor(12 / $r->frekuensi_perawatan);

        for ($i = 0; $i < $total; $i++) {
            $tgl = date('Y-m-d', strtotime($r->tanggal_mulai . ' + ' . ($i * $r->frekuensi_perawatan) . ' month'));
            $data = [
                'item_id' => $r->item_id,
                'tgl' => $tgl,
                'kesimpulan' => 'kondisi masih bagus',
                'fungsi' => 'bagus',
            ];
            PerawatanModel::create($data);
        }





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

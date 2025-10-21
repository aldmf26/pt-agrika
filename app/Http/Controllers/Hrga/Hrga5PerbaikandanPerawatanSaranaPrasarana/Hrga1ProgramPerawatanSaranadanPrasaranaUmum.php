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
        $kategori = $r->kategori ?? 'ruangan';
        $item = ItemPerawatan::where('jenis_item',  $kategori)->get();
        $data = [
            'title' => 'Program Perawatan Sarana dan Prasarana Umum',
            'lokasi' => LokasiModel::all(),
            'bulan' => DB::table('bulan')->get(),
            'tahun' => $tahun,
            'program' => ProgramPerawatanSaranaPrasarana::whereYear('tanggal_mulai', $tahun)
                ->whereHas('item', function ($query) use ($kategori) {
                    $query->where('jenis_item', $kategori);
                })
                ->orderBy('id', 'desc')
                ->get(),
            'tahuns' => ProgramPerawatanSaranaPrasarana::selectRaw('YEAR(tanggal_mulai) as tahun')
                ->distinct()
                ->pluck('tahun')
                ->toArray(),
            'kategori' =>  $kategori,
            'item' => $item,
        ];
        return view('hrga.hrga5.hrga1_programperawatansarana.index', $data);
    }

    public function load_baris(Request $r)
    {
        $kategori = $r->kategori ?? 'ruangan';
        $item = ItemPerawatan::where('jenis_item',  $kategori)->get();

        $data = [
            'item' => $item,
            'kategori' => $kategori,
            'count' => $r->count
        ];
        return view('hrga.hrga5.hrga1_programperawatansarana.tambah_baris', $data);
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
        // ProgramPerawatanSaranaPrasarana::create($r->all());

        // $item = ItemPerawatan::find($r->item_id);

        for ($i = 0; $i < count($r->item_id); $i++) {
            ProgramPerawatanSaranaPrasarana::create([
                'item_id' => $r->item_id[$i],
                'frekuensi_perawatan' => $r->frekuensi_perawatan[$i],
                'penanggung_jawab' => $r->penanggung_jawab[$i],
                'tanggal_mulai' => $r->tanggal_mulai[$i],
            ]);
            $total = floor(12 / $r->frekuensi_perawatan[$i]);

            for ($j = 0; $j < $total; $j++) {
                $item = ItemPerawatan::find($r->item_id[$i]);

                if ($item->jenis_item == 'ruangan') {
                    $rincian = DB::table('rincian_ruangan')->where('item_id', $r->item_id[$i])->get();
                    $tgl = date('Y-m-d', strtotime($r->tanggal_mulai[$i] . ' + ' . ($j * $r->frekuensi_perawatan[$i]) . ' month'));
                    foreach ($rincian as $k) {
                        $data = [
                            'item_id' => $r->item_id[$i],
                            'rincian_id' => $k->id,
                            'tgl' => $tgl,
                            'kesimpulan' => 'Meninjau kebersihan dan keadaan dinding, lantai, langit-langit',
                            'fungsi' => 'Dinding, lantai, langit-langit :tidak menimbulkan kontaminan',
                        ];
                        PerawatanModel::create($data);
                    }
                } else {
                    $tgl = date('Y-m-d', strtotime($r->tanggal_mulai[$i] . ' + ' . ($j * $r->frekuensi_perawatan[$i]) . ' month'));
                    $data = [
                        'item_id' => $r->item_id[$i],
                        'rincian_id' => 0,
                        'tgl' => $tgl,
                        'kesimpulan' => 'Permbersihan AC',
                        'fungsi' => 'Normal setelah dibersihkan, mencapai suhu yang diinginkan',
                    ];
                    PerawatanModel::create($data);
                }
            }
        }






        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $r, $id)
    {
        $r->validate([
            'item_id' => 'required',
            'frekuensi_perawatan' => 'required',
            'penanggung_jawab' => 'required',
            'tanggal_mulai' => 'required',
        ]);

        // Ambil program lama
        $program = ProgramPerawatanSaranaPrasarana::findOrFail($id);

        // Update data utama
        $program->update([
            'item_id' => $r->item_id,
            'frekuensi_perawatan' => $r->frekuensi_perawatan,
            'penanggung_jawab' => $r->penanggung_jawab,
            'tanggal_mulai' => $r->tanggal_mulai,
        ]);

        // Hapus jadwal perawatan lama
        $tahun = date('Y', strtotime($r->tanggal_mulai));
        PerawatanModel::where('item_id', $r->item_id)->whereYear('tgl', $tahun)->delete();

        // Hitung ulang jadwal baru
        $total = floor(12 / $r->frekuensi_perawatan);

        for ($j = 0; $j < $total; $j++) {
            $item = ItemPerawatan::find($r->item_id);

            $tgl = date('Y-m-d', strtotime($r->tanggal_mulai . ' + ' . ($j * $r->frekuensi_perawatan) . ' month'));

            if ($item->jenis_item == 'ruangan') {
                $rincian = DB::table('rincian_ruangan')->where('item_id', $r->item_id)->get();

                foreach ($rincian as $k) {
                    $data = [
                        'item_id' => $r->item_id,
                        'rincian_id' => $k->id,
                        'tgl' => $tgl,
                        'kesimpulan' => 'Meninjau kebersihan dan keadaan dinding, lantai, langit-langit',
                        'fungsi' => 'Dinding, lantai, langit-langit :tidak menimbulkan kontaminan',
                    ];
                    PerawatanModel::create($data);
                }
            } else {
                $data = [
                    'item_id' => $r->item_id,
                    'rincian_id' => 0,
                    'tgl' => $tgl,
                    'kesimpulan' => 'Pembersihan AC',
                    'fungsi' => 'Normal setelah dibersihkan, mencapai suhu yang diinginkan',
                ];
                PerawatanModel::create($data);
            }
        }

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }


    public function print(Request $r)
    {
        $kategori = $r->kategori ?? 'ruangan';
        $data = [
            'title' => 'Program Perawatan Sarana dan Prasarana Umum',
            'lokasi' => LokasiModel::all(),
            'bulan' => DB::table('bulan')->get(),
            'tahun' => $r->tahun,
            'program' => ProgramPerawatanSaranaPrasarana::whereYear('tanggal_mulai', $r->tahun)
                ->whereHas('item', function ($query) use ($kategori) {
                    $query->where('jenis_item', $kategori);
                })
                ->orderBy('id', 'desc')
                ->get(),
        ];
        return view('hrga.hrga5.hrga1_programperawatansarana.print', $data);
    }
}

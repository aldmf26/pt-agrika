<?php

namespace App\Http\Controllers\Hrga\Hrga5PerbaikandanPerawatanSaranaPrasarana;

use App\Http\Controllers\Controller;
use App\Models\ItemPerawatan;
use App\Models\LokasiModel;
use App\Models\PerawatanModel;
use App\Models\PermintaanPerbaikanSaranaPrasana;
use App\Models\ProgramPerawatanSaranaPrasarana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hrga2RiwayatPerwatanPerbaikan extends Controller
{
    public function index(Request $r)
    {
        $tahun = empty($r->tahun) ? date('Y') : $r->tahun;
        $kategori = empty($r->kategori) ? 'ruangan' : $r->kategori;

        $permintaan = PermintaanPerbaikanSaranaPrasana::with('item.lokasi')
            ->whereYear('tanggal', $tahun)
            ->whereHas('item', function ($query) use ($kategori) {
                $query->where('jenis_item', $kategori);
            })
            ->get()
            ->map(function ($permintaan) {
                return [
                    'id' => $permintaan->item->id ?? '-',
                    'nama_item' => empty($permintaan->item->nama_item) ? '-' :  $permintaan->item->nama_item . ' ' . $permintaan->item->merek . ' ' . $permintaan->item->no_identifikasi,
                    'lokasi' => empty($permintaan->item->nama_item) ? '-' : $permintaan->item->lokasi->lokasi,
                    'no_identifikasi' => $permintaan->item->no_identifikasi ?? '-',
                    'kategori' => 'Perbaikan',
                    'jenis' => $permintaan->item->jenis_item ?? '-',
                ];
            });

        $perawatan = PerawatanModel::with('item.lokasi')
            ->whereYear('tgl', $tahun)
            ->whereHas('item', function ($query) use ($kategori) {
                $query->where('jenis_item', $kategori);
            })
            ->get()
            ->map(function ($perawatan) {
                return [
                    'id' => $perawatan->item->id,
                    'nama_item' =>  $perawatan->item->nama_item . ' ' . $perawatan->item->merek . ' ' . $perawatan->item->no_identifikasi,
                    'lokasi' => $perawatan->item->lokasi->lokasi,
                    'no_identifikasi' => $perawatan->item->no_identifikasi ?? '-',
                    'kategori' => 'Perawatan',
                    'jenis' => $perawatan->item->jenis_item
                ];
            });

        // Pastikan hasil query selalu berupa collection
        $permintaan = collect($permintaan);
        $perawatan = collect($perawatan);

        $unionData = $permintaan->merge($perawatan);

        $grouped = $unionData->groupBy('nama_item')->map(function ($items, $namaItem) {
            return collect([
                'id' => $items->pluck('id')->unique()->join(', '),
                'nama_item' => $namaItem,
                'lokasi' => $items->pluck('lokasi')->first(),
                'no_identifikasi' => $items->pluck('no_identifikasi')->unique()->join(', '),
                'jenis' => $items->pluck('jenis')->unique()->join(', '),
            ]);
        });

        $data = [
            'title' => 'Riwayat Perbaikan dan Perawatan Sarana dan Prasarana Umum',
            'grouped' => $grouped,
            'tahun' => $tahun,
            'tahuns' => ProgramPerawatanSaranaPrasarana::selectRaw('YEAR(tanggal_mulai) as tahun')->distinct()->pluck('tahun')->toArray(),
            'kategori' => $kategori,
        ];

        return view('hrga.hrga5.hrga2_riwayatperbaikan.index', $data);
    }


    public function print(Request $r)
    {
        $items = ItemPerawatan::join('lokasi', 'item_perawatan.lokasi_id', '=', 'lokasi.id')->select('nama_item as nama_item', 'jumlah as jumlah', 'no_identifikasi', 'lokasi.lokasi', 'jenis_item')->where('item_perawatan.id', $r->id)->first();
        $perawatan = PerawatanModel::select(
            'id',
            'item_id',
            'rincian_id',
            'tgl as tanggal',
            'kesimpulan',
            'fungsi',
            DB::raw('"perawatan" as ket')
        )
            ->where('item_id', $r->id)
            ->whereBetween('tgl', [$r->tahun . '-01-01', now()])
            ->whereYear('tgl', $r->tahun);

        $perbaikan = PermintaanPerbaikanSaranaPrasana::select(
            'id',
            'item_id',
            'rincian_id',
            'tanggal',
            'detail_perbaikan as kesimpulan',
            'verifikasi_user as fungsi',
            DB::raw('"perbaikan" as ket')
        )
            ->where('item_id', $r->id)
            ->whereYear('tanggal', $r->tahun);
        $union = $perawatan->unionAll($perbaikan)->get();



        $data = [
            'title' => 'Riwayat Perbaikan dan Perawatan Sarana dan Prasarana Umum',
            'items' => $items,
            'tahun' => $r->tahun,
            'union' =>  $union,
            'jenis' => $r->jenis

        ];
        return view('hrga.hrga5.hrga2_riwayatperbaikan.print', $data);
    }
    public function edit(Request $r)
    {
        $items = ItemPerawatan::join('lokasi', 'item_perawatan.lokasi_id', '=', 'lokasi.id')->select('nama_item as nama_item', 'jumlah as jumlah', 'no_identifikasi', 'lokasi.lokasi', 'jenis_item')->where('item_perawatan.id', $r->id)->first();
        $perawatan = PerawatanModel::select(
            'id',
            'item_id',
            'rincian_id',
            'tgl as tanggal',
            'kesimpulan',
            'fungsi',
            DB::raw('"perawatan" as ket')
        )
            ->where('item_id', $r->id)
            ->whereBetween('tgl', [$r->tahun . '-01-01', now()])
            ->whereYear('tgl', $r->tahun);


        $union = $perawatan->get();



        $data = [
            'title' => 'Riwayat Perbaikan dan Perawatan Sarana dan Prasarana Umum',
            'items' => $items,
            'tahun' => $r->tahun,
            'union' =>  $union,
            'jenis' => $r->jenis

        ];
        return view('hrga.hrga5.hrga2_riwayatperbaikan.edit', $data);
    }

    public function update(Request $r)
    {
        for ($i = 0; $i < count($r->id); $i++) {
            PerawatanModel::where('id', $r->id[$i])->update([
                'kesimpulan' => $r->kesimpulan[$i],
                'fungsi' => $r->fungsi[$i],
            ]);
        }

        return redirect()->route('hrga5.2.index', ['kategori' => $r->jenis, 'tahun' => $r->tahun])->with('success', 'Data berhasil diupdate');
    }
}

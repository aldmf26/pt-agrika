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
                    'lokasi' => empty($permintaan->item->nama_item) ? '-' : $permintaan->item->lokasi->lokasi . ' lantai ' . $permintaan->item->lokasi->lantai,
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
                    'lokasi' => $perawatan->item->lokasi->lokasi . ' lantai ' . $perawatan->item->lokasi->lantai,
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
                'lokasi' => $items->pluck('lokasi')->unique()->join(', '),
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

        $items = ItemPerawatan::join('lokasi', 'item_perawatan.lokasi_id', '=', 'lokasi.id')->select('nama_item as nama_item', 'jumlah as jumlah', 'no_identifikasi', 'lokasi.lokasi')->where('item_perawatan.id', $r->id)->first();


        $perawatan = PerawatanModel::select(
            'id',
            'item_id',
            'tgl as tanggal',
            DB::raw('"perawatan" as ket')
        )
            ->where('item_id', $r->id)
            ->whereBetween('tgl', [$r->tahun . '-01-01', now()])
            ->whereYear('tgl', $r->tahun);

        $perbaikan = PermintaanPerbaikanSaranaPrasana::select('id', 'item_id', 'tanggal', DB::raw('"perbaikan" as ket'))
            ->where('item_id', $r->id)
            ->whereYear('tanggal', $r->tahun);

        $union = $perawatan->unionAll($perbaikan)->get();
        // } else {
        //     $items = LokasiModel::select(
        //         'lokasi as nama_item',
        //         DB::raw('"kosong" as merek'),
        //         DB::raw('"kosong" as no_identifikasi'),
        //         'lokasi as lokasi'
        //     )
        //         ->where('id', $r->id)
        //         ->first();


        //     $perawatan = PerawatanModel::join('item_perawatan', 'perawatan.item_id', '=', 'item_perawatan.id')
        //         ->select(
        //             'perawatan.id',
        //             'item_perawatan.nama_item',
        //             'item_perawatan.lokasi_id',
        //             'perawatan.item_id',
        //             'perawatan.tgl as tanggal',
        //             DB::raw('"perawatan" as ket') // String literal untuk jenis data
        //         )
        //         ->where('item_perawatan.lokasi_id', $r->id)
        //         ->where('item_perawatan.jenis_item', 'gabung')
        //         ->whereYear('perawatan.tgl', $r->tahun);

        //     // Query Perbaikan
        //     $perbaikan = PermintaanPerbaikanSaranaPrasana::join('item_perawatan', 'permintaan_perbaikan_sarana_prasana.item_id', '=', 'item_perawatan.id')
        //         ->select(
        //             'permintaan_perbaikan_sarana_prasana.id',
        //             'item_perawatan.nama_item',
        //             'item_perawatan.lokasi_id',
        //             'permintaan_perbaikan_sarana_prasana.item_id',
        //             'permintaan_perbaikan_sarana_prasana.tanggal',
        //             DB::raw('"perbaikan" as ket') // String literal untuk jenis data
        //         )
        //         ->where('item_perawatan.lokasi_id', $r->id)
        //         ->where('item_perawatan.jenis_item', 'gabung')
        //         ->whereYear('permintaan_perbaikan_sarana_prasana.tanggal', $r->tahun);

        //     // Union All kedua query
        //     $union = $perawatan->unionAll($perbaikan)
        //         ->orderBy('tanggal', 'asc') // Urutkan hasil berdasarkan kolom tanggal
        //         ->get();
        // }


        $data = [
            'title' => 'Riwayat Perbaikan dan Perawatan Sarana dan Prasarana Umum',
            'items' => $items,
            'tahun' => $r->tahun,
            'union' =>  $union,
            'jenis' => $r->jenis

        ];
        return view('hrga.hrga5.hrga2_riwayatperbaikan.print', $data);
    }
}

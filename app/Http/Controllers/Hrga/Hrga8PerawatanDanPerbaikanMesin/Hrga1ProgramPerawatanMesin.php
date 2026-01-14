<?php

namespace App\Http\Controllers\Hrga\Hrga8PerawatanDanPerbaikanMesin;

use App\Http\Controllers\Controller;
use App\Models\checklistPerawatanMesin;
use App\Models\ItemMesin;
use App\Models\ProgramPerawatanMesin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hrga1ProgramPerawatanMesin extends Controller
{
    public function index(Request $r)
    {
        if (empty($r->tahun)) {
            $tahun = date('Y');
        } else {
            $tahun = $r->tahun;
        }
        $kategori = $r->kategori ?? 'mesin';

        $data = [
            'title' => 'Program perawatan mesin dan peralatan',
            'bulan' => DB::table('bulan')->get(),
            'tahun' => $tahun,
            'item' => ItemMesin::where('kategori', $kategori)->get(),
            'perawatan' => ProgramPerawatanMesin::whereYear('tanggal_mulai', $tahun)
                ->whereHas('item', function ($query) use ($kategori) {
                    $query->where('kategori', $kategori);
                })
                ->orderBy('id', 'desc')
                ->get(),
            'kategori' => $kategori,
            'tahun_pilih' => ProgramPerawatanMesin::selectRaw('YEAR(tanggal_mulai) as year')
                ->distinct()
                ->orderBy('year', 'asc')
                ->pluck('year')

        ];
        return view('hrga.hrga8.hrga1_perawatan_dan_perbaikan_mesin.index', $data);
    }

    public function store(Request $r)
    {
        if ($r->has('item_mesin_id')) {

            for ($i = 0; $i < count($r->item_mesin_id); $i++) {

                // --- PERSIAPAN LOGIKA WAKTU ---
                $range_perencanaan_bulan = 60; // 5 Tahun

                $total = floor($range_perencanaan_bulan / $r->frekuensi_perawatan[$i]);
                if ($total < 1) {
                    $total = 1;
                }

                // --- LOOPING PEMBUATAN JADWAL (MASA SEKARANG & MASA DEPAN) ---
                for ($j = 0; $j < $total; $j++) {

                    // 1. Hitung Tanggal (Start Date + Interval)
                    // j=0 (2025), j=1 (2027), j=2 (2028)
                    $tambah_bulan = $j * $r->frekuensi_perawatan[$i];
                    $tgl_jadwal   = date('Y-m-d', strtotime($r->tanggal_mulai[$i] . ' + ' . $tambah_bulan . ' month'));

                    // 2. SIMPAN PROGRAM PERAWATAN DI DALAM LOOP
                    // Agar setiap tanggal (2025, 2027, dst) punya judul programnya sendiri
                    $data = [
                        'item_mesin_id'       => $r->item_mesin_id[$i],
                        'frekuensi_perawatan' => $r->frekuensi_perawatan[$i],
                        'penanggung_jawab'    => $r->penanggung_jawab[$i],
                        'tanggal_mulai'       => $tgl_jadwal, // Gunakan tanggal hasil hitungan, bukan tanggal input awal
                    ];
                    ProgramPerawatanMesin::create($data);

                    // 3. Simpan Checklist untuk tanggal tersebut
                    $kriteria = DB::table('kriteria_pemeriksaan')
                        ->where('item_mesin_id', $r->item_mesin_id[$i])
                        ->get();

                    foreach ($kriteria as $k) {
                        $checklistData = [
                            'item_mesin_id'     => $r->item_mesin_id[$i],
                            'kriteria_id'       => $k->id,
                            'tgl'               => $tgl_jadwal, // Gunakan tanggal yang sama
                            'metode'            => 'Visual',
                            'hasil_pemeriksaan' => 'Ok',
                            'status'            => 'Tidak membutuhkan perbaikan, dapat digunakan kembali',
                        ];
                        checklistPerawatanMesin::create($checklistData);
                    }
                }
            }
        }

        return redirect()
            ->route('hrga8.1.index', ['kategori' => $r->kategori])
            ->with('sukses', 'Data Berhasil Disimpan');
    }

    public function update(Request $r, $id)
    {
        // Gunakan Transaction agar jika satu gagal, semua batal (lebih aman)
        DB::transaction(function () use ($r, $id) {

            // 1. UPDATE DATA UTAMA (Jadwal Pertama/Start - Misal 2025)
            $program = ProgramPerawatanMesin::findOrFail($id);

            $program->update([
                'item_mesin_id'       => $r->item_mesin_id,
                'frekuensi_perawatan' => $r->frekuensi_perawatan,
                'penanggung_jawab'    => $r->penanggung_jawab,
                'tanggal_mulai'       => $r->tanggal_mulai,
            ]);

            // 2. BERSIHKAN DATA LAMA
            // Hapus checklist lama agar bersih
            checklistPerawatanMesin::where('item_mesin_id', $r->item_mesin_id)->delete();

            // [PENTING] Hapus Program Masa Depan (Sisa edit sebelumnya)
            // Kita hapus semua program lain milik mesin ini, KECUALI yang sedang kita edit ($id)
            ProgramPerawatanMesin::where('item_mesin_id', $r->item_mesin_id)
                ->where('id', '!=', $id)
                ->delete();

            // 3. LOGIKA HITUNG JADWAL (5 Tahun ke depan)
            $range_perencanaan_bulan = 60;

            // Pastikan frekuensi dibaca sebagai angka (integer)
            $frekuensi = intval($r->frekuensi_perawatan);

            $total = floor($range_perencanaan_bulan / $frekuensi);
            if ($total < 1) {
                $total = 1;
            }

            // 4. GENERATE ULANG JADWAL & CHECKLIST
            for ($j = 0; $j < $total; $j++) {

                // Hitung Tanggal: Start + (Urutan * Frekuensi)
                // j=0 -> +0 bulan (2025)
                // j=1 -> +18 bulan (2027)
                $tambah_bulan = $j * $frekuensi;
                $tgl_jadwal   = date('Y-m-d', strtotime($r->tanggal_mulai . ' + ' . $tambah_bulan . ' month'));

                // --- BAGIAN INI YANG MEMBUAT TAHUN 2027 MUNCUL ---

                // Jika j > 0, artinya ini adalah jadwal masa depan (2027, 2028, dst)
                // Maka kita harus CREATE data baru di tabel ProgramPerawatanMesin
                if ($j > 0) {
                    ProgramPerawatanMesin::create([
                        'item_mesin_id'       => $r->item_mesin_id,
                        'frekuensi_perawatan' => $r->frekuensi_perawatan,
                        'penanggung_jawab'    => $r->penanggung_jawab,
                        'tanggal_mulai'       => $tgl_jadwal, // Gunakan tanggal masa depan
                    ]);
                }

                // --- GENERATE CHECKLIST ---
                // Checklist dibuat untuk semua tahun (Baik 2025 maupun 2027)
                $kriteria = DB::table('kriteria_pemeriksaan')
                    ->where('item_mesin_id', $r->item_mesin_id)
                    ->get();

                foreach ($kriteria as $k) {
                    checklistPerawatanMesin::create([
                        'item_mesin_id'     => $r->item_mesin_id,
                        'kriteria_id'       => $k->id,
                        'tgl'               => $tgl_jadwal, // Tanggal sesuai loop
                        'metode'            => 'Visual',
                        'hasil_pemeriksaan' => 'Ok',
                        'status'            => 'Tidak membutuhkan perbaikan, dapat digunakan kembali',
                    ]);
                }
            }
        }); // End Transaction

        return redirect()->route('hrga8.1.index', ['kategori' => $r->kategori])
            ->with('sukses', 'Data Berhasil Diperbarui');
    }


    public function print(Request $r)
    {
        if (empty($r->tahun)) {
            $tahun = date('Y');
        } else {
            $tahun = $r->tahun;
        }
        $kategori = $r->kategori ?? 'mesin';
        $title = $kategori == 'mesin' ? 'PROGRAM PERAWATAN MESIN PROSES PRODUKSI' : 'PROGRAM PERAWATAN SOFTWARE & HARDWARE PROSES PRODUKSI';
        $no_dokumen = $kategori == 'mesin' ? 'Dok.No.: FRM.HRGA.08.01, Rev.00' : 'Dok.No.: FRM.IT.01.01, Rev.00';
        $data = [
            'title' => $title,
            'bulan' => DB::table('bulan')->get(),
            'no_dokumen' => $no_dokumen,
            'tahun' => $tahun,
            'item' => ItemMesin::where('kategori', $r->kategori)->get(),
            'perawatan' => ProgramPerawatanMesin::whereYear('tanggal_mulai', $tahun)
                ->whereHas('item', function ($query) use ($kategori) {
                    $query->where('kategori', $kategori);
                })
                ->orderBy('id', 'desc')
                ->get(),

        ];
        return view('hrga.hrga8.hrga1_perawatan_dan_perbaikan_mesin.print', $data);
    }

    public function load_baris(Request $r)
    {
        $kategori = $r->kategori;
        $item = ItemMesin::where('kategori', $kategori)->get();

        $data = [
            'item' => $item,

            'count' => $r->count
        ];
        return view('hrga.hrga8.hrga1_perawatan_dan_perbaikan_mesin.tambah_baris', $data);
    }
}

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

        ];
        return view('hrga.hrga8.hrga1_perawatan_dan_perbaikan_mesin.index', $data);
    }

    public function store(Request $r)
    {
        // Cek apakah ada data yang dikirim untuk menghindari error count() pada null
        if ($r->has('item_mesin_id')) {

            for ($i = 0; $i < count($r->item_mesin_id); $i++) {

                // 1. Simpan Data Induk Program Perawatan
                $data = [
                    'item_mesin_id'       => $r->item_mesin_id[$i],
                    'frekuensi_perawatan' => $r->frekuensi_perawatan[$i],
                    'penanggung_jawab'    => $r->penanggung_jawab[$i],
                    'tanggal_mulai'       => $r->tanggal_mulai[$i],
                ];
                ProgramPerawatanMesin::create($data);

                // 2. Logika Penentuan Jumlah Jadwal ke Depan
                // Kita set range perencanaan untuk 60 bulan (5 tahun) ke depan
                // Agar frekuensi besar (seperti 18 bulan) tetap masuk hitungan.
                $range_perencanaan_bulan = 60;

                // Hitung berapa kali perawatan terjadi dalam 5 tahun
                $total = floor($range_perencanaan_bulan / $r->frekuensi_perawatan[$i]);

                // PENTING: Jika hasil pembagian 0 (misal frekuensi > 60), 
                // paksa jadi 1 agar minimal tersimpan tanggal mulainya.
                if ($total < 1) {
                    $total = 1;
                }

                // 3. Looping untuk generate Checklist sesuai frekuensi
                for ($j = 0; $j < $total; $j++) {

                    // Ambil kriteria berdasarkan item mesin saat ini
                    $kriteria = DB::table('kriteria_pemeriksaan')
                        ->where('item_mesin_id', $r->item_mesin_id[$i])
                        ->get();

                    // Hitung tanggal jadwal: Tanggal Mulai + (Urutan Loop * Frekuensi Bulan)
                    // Contoh: Loop 0 = +0 bulan, Loop 1 = +18 bulan, dst.
                    $tambah_bulan = $j * $r->frekuensi_perawatan[$i];
                    $tgl = date('Y-m-d', strtotime($r->tanggal_mulai[$i] . ' + ' . $tambah_bulan . ' month'));

                    // Simpan setiap kriteria ke tabel checklist
                    foreach ($kriteria as $k) {
                        $checklistData = [
                            'item_mesin_id'     => $r->item_mesin_id[$i],
                            'kriteria_id'       => $k->id,
                            'tgl'               => $tgl,
                            'metode'            => 'Visual', // Default value
                            'hasil_pemeriksaan' => 'Ok',     // Default value
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
        // 1. Ambil data utama program perawatan
        $program = ProgramPerawatanMesin::findOrFail($id);

        // 2. Update data utama
        $program->update([
            'item_mesin_id'       => $r->item_mesin_id,
            'frekuensi_perawatan' => $r->frekuensi_perawatan,
            'penanggung_jawab'    => $r->penanggung_jawab,
            'tanggal_mulai'       => $r->tanggal_mulai,
        ]);

        // 3. Hapus checklist lama
        // CATATAN: Hati-hati, ini menghapus SEMUA riwayat checklist item ini (termasuk yg sudah dikerjakan).
        // Jika ingin menghapus jadwal masa depan saja, tambahkan ->where('tgl', '>=', date('Y-m-d'))
        checklistPerawatanMesin::where('item_mesin_id', $r->item_mesin_id)->delete();

        // 4. Hitung ulang jadwal checklist (Logika Baru 5 Tahun / 60 Bulan)
        $range_perencanaan_bulan = 60;

        // Hitung berapa kali loop harus berjalan
        $total = floor($range_perencanaan_bulan / $r->frekuensi_perawatan);

        // Safety check: Jika frekuensi > 60 bulan, paksa minimal 1x (tanggal mulai)
        if ($total < 1) {
            $total = 1;
        }

        // 5. Generate ulang checklist
        for ($j = 0; $j < $total; $j++) {

            $kriteria = DB::table('kriteria_pemeriksaan')
                ->where('item_mesin_id', $r->item_mesin_id)
                ->get();

            // Hitung tanggal: start + (urutan * frekuensi)
            $tambah_bulan = $j * $r->frekuensi_perawatan;
            $tgl = date('Y-m-d', strtotime($r->tanggal_mulai . ' + ' . $tambah_bulan . ' month'));

            foreach ($kriteria as $k) {
                $dataChecklist = [
                    'item_mesin_id'     => $r->item_mesin_id,
                    'kriteria_id'       => $k->id,
                    'tgl'               => $tgl,
                    'metode'            => 'Visual',
                    'hasil_pemeriksaan' => 'Ok',
                    'status'            => 'Tidak membutuhkan perbaikan, dapat digunakan kembali',
                ];
                checklistPerawatanMesin::create($dataChecklist);
            }
        }

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

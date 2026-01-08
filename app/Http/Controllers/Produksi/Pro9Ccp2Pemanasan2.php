<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Carbon\Carbon;

class Pro9Ccp2Pemanasan2 extends Controller
{
    public function index(Request $r)
    {

        $data = [
            'title' => 'Form pemanasan CCP 2',
            'pemanasan' => DB::select("SELECT a.tgl, b.pcs, b.gr FROM header_ccp2 as a 
            left join (
                SELECT b.tanggal, sum(b.pcs) as pcs, sum(b.gr) as gr FROM pemanasan_cpp2s as b 
                group by b.tanggal
            ) as b on b.tanggal = a.tgl

            order by a.tgl DESC
            "),
        ];
        return view('produksi.pro9ccp2pemanasan2.index', $data);
    }

    public function print(Request $r)
    {
        $tgl = $r->tgl;

        $pemanasan = DB::table('pemanasan_cpp2s')->where('tanggal', $r->tgl)->get();
        $data = [
            'title' => 'Form pemanasan CCP 2',
            'pemanasan' => $pemanasan,
            'tgl' => $tgl,

            'header' => DB::table('header_ccp2')->where('tgl', $r->tgl)->first()

        ];
        return view('produksi.pro9ccp2pemanasan.print', $data);
    }
    public function print2(Request $r)
    {
        $tgl = $r->tgl;

        // 1. Ambil Data Mentah
        $rawPemanasan = DB::table('pemanasan_cpp2s')
            ->where('tanggal', $r->tgl)
            ->get();

        // 2. Proses Pecah Data & Logika Pembagian Berat
        // 2. Proses Pecah Data & Logika Pembagian Berat
        $pemanasanProcessed = $rawPemanasan->flatMap(function ($item) {
            // --- PERBAIKAN DI SINI ---
            $gradesRaw = explode(',', $item->grade_akhir);

            // Filter: Hanya ambil yang tidak kosong
            $grades = array_values(array_filter($gradesRaw, function ($value) {
                return trim($value) !== ''; // Hapus jika cuma spasi atau kosong
            }));
            // -------------------------

            $jumlah_grade = count($grades);

            // Jika setelah difilter ternyata kosong (misal datanya ",,"), return kosong
            if ($jumlah_grade == 0) return [];

            $total_pcs = $item->pcs;
            $total_gr = $item->gr;

            $hasil_split = [];

            // ... LANJUTKAN KODE PERHITUNGAN SEPERTI SEBELUMNYA DI BAWAH INI ...

            // Hitung porsi berat & pcs
            if ($jumlah_grade == 1) {
                // ... logic sama ...
                $porsi_utama_gr = $total_gr;
                $porsi_sisa_gr = 0;
                $porsi_utama_pcs = $total_pcs;
                $porsi_sisa_pcs = 0;
            } else {
                // ... logic sama ...
                $porsi_utama_gr = $total_gr * 0.5;
                $sisa_gr_total = $total_gr - $porsi_utama_gr;
                $porsi_sisa_gr = $sisa_gr_total / ($jumlah_grade - 1);

                $porsi_utama_pcs = floor($total_pcs * 0.5);
                $sisa_pcs_total = $total_pcs - $porsi_utama_pcs;
                $porsi_sisa_pcs = floor($sisa_pcs_total / ($jumlah_grade - 1));
            }

            foreach ($grades as $index => $gradeRaw) {
                $gradeClean = trim($gradeRaw);

                if ($index == 0) {
                    $fix_gr = $porsi_utama_gr;
                    $fix_pcs = $porsi_utama_pcs;
                } else {
                    $fix_gr = $porsi_sisa_gr;
                    $fix_pcs = $porsi_sisa_pcs;
                }

                $newRow = clone $item;
                $newRow->grade_akhir = $gradeClean;
                $newRow->gr = $fix_gr;
                $newRow->pcs = $fix_pcs;

                $hasil_split[] = $newRow;
            }

            return $hasil_split;
        });

        // ... code sebelumnya ...
        $pemanasanMerged = $pemanasanProcessed->groupBy('grade_akhir')->map(function ($rowGroup) {
            $firstItem = $rowGroup->first();

            return (object) [
                'grade_akhir' => $firstItem->grade_akhir,
                'pcs' => $rowGroup->sum('pcs'),
                'gr'  => $rowGroup->sum('gr'),

                // --- PERBAIKAN DI SINI ---
                'kode_batch' => $rowGroup->pluck('kode_batch')
                    ->flatMap(function ($item) {
                        return explode(',', $item); // 1. Pecah jika dalam 1 cell ada banyak koma
                    })
                    ->map(function ($item) {
                        return trim($item); // 2. Hapus spasi berlebih
                    })
                    ->filter(function ($item) {
                        return $item != ''; // 3. Hapus yang kosong
                    })
                    ->unique()   // 4. Pastikan unik (Hapus duplikat)
                    ->values()   // 5. Reset nomor urut array
                    ->toArray(), // 6. Kirim sebagai ARRAY (bukan string)
                // -------------------------

                'grade_awal' => $rowGroup->pluck('grade_awal')->unique()->implode(', '),
                'tanggal' => $firstItem->tanggal,
            ];
        });
        // ... code setelahnya ...

        // 4. Sorting
        // Urutkan berdasarkan Abjad (D, S, V, Y, dst)
        $finalData = $pemanasanMerged->sortBy('grade_akhir')->values();

        $data = [
            'title' => 'Form pemanasan CCP 2',
            'pemanasan' => $finalData, // Gunakan variabel hasil merging
            'tgl' => $tgl,
            'header' => DB::table('header_ccp2')->where('tgl', $r->tgl)->first()
        ];

        return view('produksi.pro9ccp2pemanasan2.print2', $data);
    }

    public function delete(Request $r)
    {
        DB::table('header_ccp2')->where('tgl', $r->tgl)->delete();
        DB::table('pemanasan_cpp2s')->where('tanggal', $r->tgl)->delete();

        return redirect()->route('produksi.9.2.index')->with('sukses', 'Data berhasil dihapus');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $spreadsheet = IOFactory::load($request->file('file'));
        $sheet = $spreadsheet->getActiveSheet();

        DB::beginTransaction();
        try {
            $excelDate = $sheet->getCell('B1')->getValue();

            $tgl = null;
            if (!empty($excelDate)) {
                $tgl = Carbon::instance(
                    ExcelDate::excelToDateTimeObject($excelDate)
                )->format('Y-m-d');
            }

            /** ================= HEADER ================= */
            $header = DB::table('header_ccp2')->insert([
                'tgl'      => $tgl,
                'suhu_ruang'        => $sheet->getCell('F1')->getValue(),
                'suhu_sbw_awal'  => $sheet->getCell('B3')->getValue(),
            ]);

            /** ================= DETAIL ================= */
            $startRow = 8; // data mulai row 8
            $lastRow  = $sheet->getHighestRow();

            for ($row = $startRow; $row <= $lastRow; $row++) {

                // skip kalau baris kosong
                if (!$sheet->getCell("A$row")->getValue()) {
                    continue;
                }

                $excelTime = $sheet->getCell("G$row")->getValue();

                $waktuMulaiSteam = null;
                if (!empty($excelTime)) {
                    $waktuMulaiSteam = Carbon::instance(
                        ExcelDate::excelToDateTimeObject($excelTime)
                    )->format('H:i:s');
                }

                DB::table('pemanasan_cpp2s')->insert([
                    'tanggal' => $tgl,
                    'urutan_pemanasan' => $sheet->getCell("A$row")->getValue(),
                    'tray'           => $sheet->getCell("B$row")->getValue(),
                    'kode_batch'       => $sheet->getCell("C$row")->getValue(),
                    'grade_awal'       => $sheet->getCell("D$row")->getValue(),
                    'jenis_produk_akhir' => $sheet->getCell("E$row")->getValue(),
                    'grade_akhir'      => $sheet->getCell("F$row")->getValue(),
                    'waktu_mulai_steam' => $waktuMulaiSteam,
                    'pcs'       => $sheet->getCell("H$row")->getValue(),
                    'gr'        => $sheet->getCell("I$row")->getValue(),
                    'tventing_c'      => $sheet->getCell("J$row")->getValue(),
                    'tventing_mnt'    => $sheet->getCell("K$row")->getValue(),
                    'ttot_c'           => $sheet->getCell("L$row")->getValue(),
                    'ttot_mnt'         => $sheet->getCell("M$row")->getValue(),
                    'keterangan'       => $sheet->getCell("O$row")->getValue(),
                ]);
            }

            DB::commit();
            return back()->with('success', 'Import CCP2 berhasil');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}

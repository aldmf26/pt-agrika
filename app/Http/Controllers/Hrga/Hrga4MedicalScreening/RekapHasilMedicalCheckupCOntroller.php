<?php

namespace App\Http\Controllers\Hrga\Hrga4MedicalScreening;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Carbon\Carbon;

class RekapHasilMedicalCheckupCOntroller extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Rekap Hasil Medical Checkup',
            'rekap' => DB::table('hasil_medical_checkup')->get()
        ];

        return view('hrga.hrga4.hrga2hasilmedical.index', $data);
    }
    public function print()
    {
        $data = [
            'title' => 'REKAP HASIL MEDICAL CHECK UP',
            'dok' => 'Dok.No.: FRM.HRGA.04.02, Rev.00',
            'rekap' => DB::table('hasil_medical_checkup')->get()
        ];

        return view('hrga.hrga4.hrga2hasilmedical.print', $data);
    }



    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        // hapus data lama
        DB::table('hasil_medical_checkup')->truncate();

        foreach ($rows as $index => $row) {
            if ($index <= 1) {
                continue; // skip judul & header
            }

            // kalau semua kolom kosong, skip
            if (empty(array_filter($row))) {
                continue;
            }

            // kalau nama kosong, skip (biar gak insert baris kosong)
            if (empty($row[1])) {
                continue;
            }

            $tglPemeriksaan = null;
            if (!empty($row[3])) {
                if (is_numeric($row[3])) {
                    $tglPemeriksaan = ExcelDate::excelToDateTimeObject($row[3])->format('Y-m-d');
                } else {
                    $tglPemeriksaan = Carbon::parse($row[3])->format('Y-m-d');
                }
            }

            DB::table('hasil_medical_checkup')->insert([
                'nama'                   => trim($row[1] ?? ''),
                'tempat_tgl_lahir'       => trim($row[2] ?? ''),
                'tgl_pemeriksaan'        => $tglPemeriksaan,
                'jenis_kelamin'          => trim($row[4] ?? ''),
                'bagian'                 => trim($row[5] ?? ''),
                'hbsag'                  => trim($row[6] ?? ''),
                'anti_hbs'               => trim($row[7] ?? ''),
                'salmonella_typhi_o'     => trim($row[8] ?? ''),
                'salmonella_typhi_h'     => trim($row[9] ?? ''),
                'salmonella_paratyphi_a' => trim($row[10] ?? ''),
                'salmonella_paratyphi_b' => trim($row[11] ?? ''),
                'sputum_bta'             => trim($row[12] ?? ''),
                'mh_kusta'               => trim($row[13] ?? ''),
                'swab_antigen'           => trim($row[14] ?? ''),
                'status'                 => trim($row[15] ?? ''),
                'tindakan'               => trim($row[16] ?? ''),
            ]);
        }

        return redirect()->back()->with('sukses', 'Data berhasil diimport!');
    }
}

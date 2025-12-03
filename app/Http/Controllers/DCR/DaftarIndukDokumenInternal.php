<?php

namespace App\Http\Controllers\DCR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Carbon\Carbon;

class DaftarIndukDokumenInternal extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Induk Dokumen Internal',
            'daftar' => DB::table('daftar_induk_dokumen_internal')->get()
        ];

        return view('dcr.daftar_induk_dokumen_internal.index', $data);
    }
    public function print()
    {
        $data = [
            'title' => 'DAFTAR INDUK DOKUMEN INTERNAL',
            'dok' => 'Dok.No.: FRM.DCR.01.01, Rev.00',
            'daftar' => DB::table('daftar_induk_dokumen_internal')->orderBy('no_dokumen', 'asc')->get()
        ];

        return view('dcr.daftar_induk_dokumen_internal.print', $data);
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


        foreach ($rows as $index => $row) {
            if ($index <= 0) {
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

            // $tglPemeriksaan = null;
            // if (!empty($row[3])) {
            //     if (is_numeric($row[3])) {
            //         $tglPemeriksaan = ExcelDate::excelToDateTimeObject($row[3])->format('Y-m-d');
            //     } else {
            //         $tglPemeriksaan = Carbon::parse($row[3])->format('Y-m-d');
            //     }
            // }

            $cek = DB::table('daftar_induk_dokumen_internal')->where('no_dokumen', trim($row[4] ?? ''))->first();
            if ($cek) {
                // update
                DB::table('daftar_induk_dokumen_internal')->where('id', $cek->id)->update([
                    'nama_divisi' => trim($row[1] ?? ''),
                    'pic' => trim($row[2] ?? ''),
                    'judul' => trim($row[3] ?? ''),
                    'no_dokumen' => trim($row[4] ?? ''),
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('daftar_induk_dokumen_internal')->insert([
                    'nama_divisi' => trim($row[1] ?? ''),
                    'pic' => trim($row[2] ?? ''),
                    'judul' => trim($row[3] ?? ''),
                    'no_dokumen' => trim($row[4] ?? ''),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->back()->with('sukses', 'Data berhasil diimport!');
    }

    public function export()
    {
        $data = DB::table('daftar_induk_dokumen_internal')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header Excel
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Divisi');
        $sheet->setCellValue('C1', 'PIC');
        $sheet->setCellValue('D1', 'Judul');
        $sheet->setCellValue('E1', 'No Dokumen');

        $row = 2;
        $no = 1;

        foreach ($data as $d) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $d->nama_divisi);
            $sheet->setCellValue('C' . $row, $d->pic);
            $sheet->setCellValue('D' . $row, $d->judul);
            $sheet->setCellValue('E' . $row, $d->no_dokumen);
            $row++;
        }

        // ==== Tambahin BORDER ====
        $lastRow = $row - 1;
        $range = 'A1:E' . $lastRow;

        $sheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Auto size kolom
        foreach (range('A', 'E') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Nama file
        $fileName = 'daftar-dokumen-' . date('YmdHis') . '.xlsx';

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$fileName\"");

        $writer->save('php://output');
        exit;
    }
}

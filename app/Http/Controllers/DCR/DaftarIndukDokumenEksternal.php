<?php

namespace App\Http\Controllers\DCR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Carbon\Carbon;

class DaftarIndukDokumenEksternal extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Induk Dokumen Eksternal',
            'daftar' => DB::table('daftar_induk_dokumen_eksternal')->get()
        ];
        return view('dcr.daftar_induk_dokumen_eksternal.index', $data);
    }
    public function print()
    {
        $data = [
            'title' => 'DAFTAR INDUK DOKUMEN EKSTERNAL',
            'dok' => 'Dok.No.: FRM.DCR.01.02, Rev.00',
            'daftar' => DB::table('daftar_induk_dokumen_eksternal')->orderBy('id', 'asc')->get()
        ];

        return view('dcr.daftar_induk_dokumen_eksternal.print', $data);
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
        DB::table('daftar_induk_dokumen_eksternal')->truncate();


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

            $peninjauan = null;
            if (!empty($row[3])) {
                if (is_numeric($row[3])) {
                    $peninjauan = ExcelDate::excelToDateTimeObject($row[3])->format('Y-m-d');
                } else {
                    $peninjauan = Carbon::parse($row[3])->format('Y-m-d');
                }
            }


            DB::table('daftar_induk_dokumen_eksternal')->insert([
                'judul_dokumen' => trim($row[1] ?? ''),
                'no_dokumen' => trim($row[2] ?? ''),
                'peninjauan_terakhir' => $peninjauan,
                'status' => trim($row[4] ?? ''),

            ]);
        }

        return redirect()->back()->with('sukses', 'Data berhasil diimport!');
    }
}

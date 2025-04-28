<?php

namespace App\Http\Controllers\QA\TinjauanManajemen;

use App\Http\Controllers\Controller;
use App\Models\AgendadanJadwalTinjauanManajemen;
use App\Models\notulenTinjauanManajemen;
use Illuminate\Http\Request;
use Mockery\Matcher\Not;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class NotulenTinjauanManajemenController extends Controller
{
    public function index()
    {
        $agenda = AgendadanJadwalTinjauanManajemen::selectRaw('tanggal, COUNT(*) as jumlah_agenda')
            ->groupBy('tanggal')
            ->get();

        $data = [
            'title' => 'Notulen Tinjauan Manajemen',
            'agenda' => $agenda,
        ];
        return view('qa.tinjauan_manajemen.notulen_tinjauan_manajemen.index', $data);
    }

    public function print(Request $r)
    {

        $notulen = notulenTinjauanManajemen::all();
        if ($notulen->isEmpty()) {
            $notulen_detail = AgendadanJadwalTinjauanManajemen::where('tanggal', $r->tanggal)->get();
        } else {
            $notulen_detail = notulenTinjauanManajemen::where('tanggal', $r->tanggal)->get();
            if ($notulen_detail->isEmpty()) {
                $cek_notulen = notulenTinjauanManajemen::orderBy('tanggal', 'desc')->limit(1)->first();
                $notulen_detail = notulenTinjauanManajemen::where('tanggal', $cek_notulen->tanggal)->get();
            } else {
                $notulen_detail = notulenTinjauanManajemen::where('tanggal', $r->tanggal)->get();
            }
        }

        $data = [
            'title' => 'Notulen Tinjauan Manajemen',
            'agenda' => AgendadanJadwalTinjauanManajemen::where('tanggal', $r->tanggal)->get(),
            'tanggal' => $r->tanggal,
            'notulen' => $notulen_detail,
        ];
        return view('qa.tinjauan_manajemen.notulen_tinjauan_manajemen.print', $data);
    }

    public function export(Request $r)
    {
        $notulen = notulenTinjauanManajemen::all();
        if ($notulen->isEmpty()) {
            $notulen_detail = AgendadanJadwalTinjauanManajemen::where('tanggal', $r->tanggal)->get();
        } else {
            $notulen_detail = notulenTinjauanManajemen::where('tanggal', $r->tanggal)->get();
            if ($notulen_detail->isEmpty()) {
                $cek_notulen = notulenTinjauanManajemen::orderBy('tanggal', 'desc')->limit(1)->first();
                $notulen_detail = notulenTinjauanManajemen::where('tanggal', $cek_notulen->tanggal)->get();
            } else {
                $notulen_detail = notulenTinjauanManajemen::where('tanggal', $r->tanggal)->get();
            }
        }

        $agenda = AgendadanJadwalTinjauanManajemen::where('tanggal', $r->tanggal)->pluck('agenda')->toArray();
        $agenda_string = implode(", ", $agenda);

        $styleBaris = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $style_atas = array(
            'font' => [
                'bold' => true, // Mengatur teks menjadi tebal
            ],

            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ]
            ],
        );

        // Mulai bikin spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Agenda');
        $sheet->setCellValue('C1', 'Hasil Pembahasan');
        $sheet->setCellValue('D1', 'Action Plan');
        $sheet->setCellValue('E1', 'PIC');
        $sheet->setCellValue('F1', 'Due Date');
        $sheet->setCellValue('G1', 'Status');

        // Data
        $row = 2;
        $no = 1;
        foreach ($notulen_detail as $n) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $n->agenda ?? '-');
            $sheet->setCellValue('C' . $row, $n->hasil_pembahasan ?? '-');
            $sheet->setCellValue('D' . $row, $n->action_plan ?? '-');
            $sheet->setCellValue('E' . $row, $n->pic ?? '-');
            $sheet->setCellValue('F' . $row, $n->duedate ?? '-');
            $sheet->setCellValue('G' . $row, $n->status ?? '-');
            $row++;
        }
        $sheet->getStyle('A1:G1')->applyFromArray($style_atas);
        $sheet->getStyle('A2:G' . $row - 1)->applyFromArray($styleBaris);
        // Buat file response
        $writer = new Xlsx($spreadsheet);
        $filename = 'notulen_tinjauan_manajemen.xlsx';

        // Output langsung ke browser
        $temp_file = tempnam(sys_get_temp_dir(), $filename);
        $writer->save($temp_file);

        return response()->download($temp_file, $filename)->deleteFileAfterSend(true);
    }

    public function import(Request $r)
    {
        $r->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        notulenTinjauanManajemen::where('tanggal', $r->tanggal)->delete();

        $file = $r->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        // Skip header
        foreach (array_slice($rows, 1) as $row) {
            $agenda = $row[1]; // Kolom B
            $hasil_peninjauan = $row[2];  // Kolom C
            $action_plan = $row[3]; // Kolom D
            $pic = $row[4]; // Kolom E
            $due_date = $row[5]; // Kolom F
            $status = $row[6]; // Kolom G

            // Simpan ke tabel (contoh: notulenTinjauanManajemen)
            notulenTinjauanManajemen::create([
                'agenda' => $agenda,
                'hasil_pembahasan' => $hasil_peninjauan,
                'action_plan' => $action_plan,
                'pic' => $pic,
                'duedate' => $due_date,
                'status' => $status,
                'tanggal' => $r->tanggal,
            ]);
        }

        return redirect()->route('qa.notulen_tinjauan_manajemen.index')->with('sukses', 'Data Berhasil Di Import');
    }
}

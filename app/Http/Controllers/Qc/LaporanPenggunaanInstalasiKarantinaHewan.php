<?php

namespace App\Http\Controllers\Qc;

use App\Http\Controllers\Controller;
use App\Models\HeaderLaporanPenggunaanInstalasi;
use App\Models\LaporanPenggunaanInstalasiKarantina;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class LaporanPenggunaanInstalasiKarantinaHewan extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Laporan Penggunaan Instalasi Karantina Hewan',
            'laporan' => HeaderLaporanPenggunaanInstalasi::orderBy('created_at', 'desc')->get(),
        ];
        return view('qc.laporan_penggunaan_instalasi_karantina_hewan.index', $data);
    }

    public function print(Request $r)
    {
        $data = [
            'title' => 'Laporan Penggunaan Instalasi Karantina Hewan',
            'laporan' => HeaderLaporanPenggunaanInstalasi::where('nota', $r->nota)->first(),
            'laporan_detail' => LaporanPenggunaanInstalasiKarantina::where('nota', $r->nota)->get(),
        ];
        return view('qc.laporan_penggunaan_instalasi_karantina_hewan.print', $data);
    }

    public function import(Request $r)
    {
        $r->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);
        $file = $r->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();



        // Skip header
        // foreach (array_slice($rows, 1) as $row) {
        //     $agenda = $row[1]; // Kolom B
        //     $hasil_peninjauan = $row[2];  // Kolom C
        //     $action_plan = $row[3]; // Kolom D
        //     $pic = $row[4]; // Kolom E
        //     $due_date = $row[5]; // Kolom F
        //     $status = $row[6]; // Kolom G

        //     // Simpan ke tabel (contoh: notulenTinjauanManajemen)
        //     notulenTinjauanManajemen::create([
        //         'agenda' => $agenda,
        //         'hasil_pembahasan' => $hasil_peninjauan,
        //         'action_plan' => $action_plan,
        //         'pic' => $pic,
        //         'duedate' => $due_date,
        //         'status' => $status,
        //         'tanggal' => $r->tanggal,
        //     ]);
        // }
        $nota = $r->file('file')->getClientOriginalName();



        HeaderLaporanPenggunaanInstalasi::where('nota', $nota)->delete();
        LaporanPenggunaanInstalasiKarantina::where('nota', $nota)->delete();


        HeaderLaporanPenggunaanInstalasi::create(
            [
                'nota' => $nota,
                'nama_pemilik' => substr($rows[10][4], 2),
                'no_sk' => substr($rows[11][4], 2),
                'masa_berlaku' => substr($rows[12][4], 2),
                'jenis_media_pembawa' => substr($rows[13][4], 2),
                'negara_asal' => substr($rows[14][4], 2),
                'kapasitas' => substr($rows[15][4], 2),
                'perusahaan' => substr($rows[12][9], 2),
                'alamat' => substr($rows[13][9], 2),
                'no_telp' => substr($rows[14][9], 2),

            ]
        );

        foreach (array_slice($rows, 19) as $row) {
            if (isset($row[1]) && stripos($row[1], 'Total') !== false) {
                break;
            }
            if (empty($row[2]) ||  empty($row[7])) {
                continue; // Skip empty rows
            }



            // Kolom B
            $tgl = Carbon::createFromFormat('m/d/Y', trim($row[2]))->format('Y-m-d');
            $jenis_media_pembawa = $row[3];  // Kolom C
            $jumlah = $row[4]; // Kolom D
            $negara_asal = $row[5]; // Kolom E
            $negara_tujuan = $row[6]; // Kolom F
            $tgl_pengeluaran = Carbon::createFromFormat('m/d/Y', trim($row[7]))->format('Y-m-d');
            $petugas_karantina_hewan = $row[8]; // Kolom H
            $kejadian = $row[9]; // Kolom I
            $keterangan = $row[10]; // Kolom J


            // Simpan ke tabel (contoh: notulenTinjauanManajemen)
            LaporanPenggunaanInstalasiKarantina::create([
                'tgl' => $tgl,
                'jenis_media_pembawa' => $jenis_media_pembawa,
                'jumlah' => $jumlah,
                'negara_asal' => $negara_asal,
                'negara_tujuan' => $negara_tujuan,
                'tgl_pengeluaran' => $tgl_pengeluaran,
                'petugas_karantina_hewan' => $petugas_karantina_hewan,
                'kejadian' => $kejadian,
                'keterangan' => $keterangan,
                'nota' => $nota,
            ]);
        }


        return redirect()->route('qc.laporan_penggunaan_instalasi_karantina_hewan.index')->with('sukses', 'Data Berhasil Di Import');
    }
}

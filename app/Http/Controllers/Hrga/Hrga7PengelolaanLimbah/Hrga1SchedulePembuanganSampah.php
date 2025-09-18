<?php

namespace App\Http\Controllers\Hrga\Hrga7PengelolaanLimbah;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hrga1SchedulePembuanganSampah extends Controller
{
    protected $view = 'hrga.hrga7.hrga1_schedule_pembuangan_sampah';
    public function index(Request $r)
    {
        $kategori = $r->kategori ?? 'terjadwal';
        $datas = DB::select("SELECT month(a.tgl) as bulan,year(a.tgl) as tahun,a.jenis_sampah FROM pembuangan_sampahs as a
        WHERE a.kategori = '$kategori'
        group BY month(a.tgl),a.jenis_sampah");

        $data = [
            'title' => 'Pembuangan Sampah',
            'datas' => $datas,
            'kategori' => $r->kategori ?? 'terjadwal'
        ];

        return view('hrga.hrga7.hrga1_schedule_pembuangan_sampah.index', $data);
    }

    public function create(Request $r)
    {
        $data = [
            'title' => 'Tambah Pembuangan Sampah',
            'kategori' => $r->kategori ?? 'terjadwal',
            'bulan' => DB::table('bulan')->get(),
        ];
        return view("hrga.hrga7.hrga1_schedule_pembuangan_sampah.create", $data);
    }

    public function print(Request $r)
    {
        $jenis_limbah = $r->jenis_limbah;
        $nm_bulan = DB::table('bulan')->where('id_bulan', $r->bulan)->first();
        $data = [
            'title' => 'SCHEDULE PEMBUANGAN SAMPAH',
            'dok' => 'Dok.No. : FRM.HRGA.07.01, Rev.00',
            'nm_bulan' => $nm_bulan->nm_bulan,
            'kategori' => $r->kategori,

            'jenis_limbah' => $jenis_limbah,
            'pembuangan' => DB::table('pembuangan_sampahs')
                ->whereMonth('tgl', $r->bulan)
                ->whereYear('tgl', date('Y'))
                ->where('jenis_sampah', $jenis_limbah)
                ->where('kategori', $r->kategori)
                ->groupBy('tgl')
                ->orderBy('tgl', 'ASC')
                ->get(),


        ];
        return view("hrga.hrga7.hrga1_schedule_pembuangan_sampah.print", $data);
    }

    public function store(Request $r)
    {


        // Looping tanggal
        if ($r->kategori == 'terjadwal') {
            $bulan = $r->bulan;
            $tahun = date('Y');

            $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
            for ($i = 1; $i <= $jumlahHari; $i++) {
                $tanggal = sprintf('%04d-%02d-%02d', $tahun, $bulan, $i); // format YYYY-MM-DD

                $data = [
                    'tgl' => $tanggal,
                    'jenis_sampah' => $r->jenis_sampah,
                    'jam_cek' => $r->jam_cek,
                    'kategori' => $r->kategori,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'admin' => auth()->user()->name
                ];
                DB::table('pembuangan_sampahs')->insert($data);
            }
        } else {
            for ($i = 0; $i < count($r->tgl); $i++) {


                $data = [
                    'tgl' => $r->tgl[$i],
                    'jenis_sampah' => $r->jenis_sampah,
                    'jam_cek' => $r->jam_cek[$i],
                    'kategori' => $r->kategori,
                    'berat' => $r->berat[$i],
                    'katerangan' => $r->katerangan[$i] ?? '',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'admin' => auth()->user()->name
                ];
                DB::table('pembuangan_sampahs')->insert($data);
            }
        }
        return redirect()->route('hrga7.1.index')->with('sukses', 'Data berhasil disimpan');
    }
}

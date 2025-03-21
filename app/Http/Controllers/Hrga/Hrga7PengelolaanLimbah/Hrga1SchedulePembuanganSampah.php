<?php

namespace App\Http\Controllers\Hrga\Hrga7PengelolaanLimbah;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hrga1SchedulePembuanganSampah extends Controller
{
    protected $view = 'hrga.hrga7.hrga1_schedule_pembuangan_sampah';
    public function index()
    {
        $datas = DB::select("SELECT month(a.tgl) as bulan,year(a.tgl) as tahun,a.jenis_sampah FROM pembuangan_sampahs as a
        group BY month(a.tgl),a.jenis_sampah");

        $data = [
            'title' => 'Pembuangan Sampah',
            'datas' => $datas
        ];

        return view("$this->view.index", $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Pembuangan Sampah'
        ];
        return view("{$this->view}.create", $data);
    }

    public function print(Request $r)
    {
        $jenis_limbah = $r->jenis_limbah;
        $daysInMonth = Carbon::create(2023, $r->bulan)->daysInMonth;
        $jamList = [
            ['time' => '07:00:00', 'label' => 'AM'],
            ['time' => '04:00:00', 'label' => 'PM'],
        ];
        $nm_bulan = DB::table('bulan')->where('id_bulan', $r->bulan)->first();
        $data = [
            'title' => 'SCHEDULE PEMBUANGAN SAMPAH',
            'dok' => 'FRM.HRGA.07.01, Rev.00',
            'nm_bulan' => $nm_bulan->nm_bulan,
            'selectedBulan' => $nm_bulan->bulan,
            'jenis_limbah' => $jenis_limbah,
            'daysInMonth' => $daysInMonth,
            'jamList' => $jamList,
            'tbl' => 'pembuangan_sampahs',

        ];
        return view("{$this->view}.print", $data);
    }
}

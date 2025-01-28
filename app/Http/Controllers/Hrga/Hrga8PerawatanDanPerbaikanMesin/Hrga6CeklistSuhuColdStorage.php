<?php

namespace App\Http\Controllers\Hrga\Hrga8PerawatanDanPerbaikanMesin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hrga6CeklistSuhuColdStorage extends Controller
{
    protected $view = 'hrga.hrga8.hrga6_ceklist_suhu_cold_storage';
    public function index()
    {
        $datas = DB::select("SELECT month(tgl) as bulan,year(tgl) as tahun,standar_suhu,ruangan FROM hrga8_ceklist_suhu_cold_storage as a
        group BY month(tgl),standar_suhu,ruangan");
        
        $data = [
            'title' => 'Ceklist Suhu Cold Storage',
            'datas' => $datas
        ];
        return view($this->view .'.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Ceklist Suhu Cold Storage'
        ];
        return view($this->view .'.create', $data);
    }
    public function print(Request $r)
    {
        $title = 'CEKLIST SUHU COLD STORAGE';
        $dok = 'FRM.HRGA.08.06, Rev.00';
        $ruangan = $r->ruangan;
        $standard = $r->standardSuhu;
        $tahun = $r->tahun;
        $bulan = $r->bulan;
        $daysInMonth = Carbon::create(2023, $bulan)->daysInMonth;
        $nm_bulan = DB::table('bulan')->where('id_bulan', $r->bulan)->first()->nm_bulan;

        return view(
            $this->view . '.print',
            compact(
                'title',
                'ruangan',
                'standard',
                'dok',
                'daysInMonth',
                'tahun',
                'bulan',
                'nm_bulan'
            )
        );
    }
}

<?php

namespace App\Http\Controllers\Hrga\Hrga6Sanitasi;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hrga2CeklistSanitasi extends Controller
{
    protected $view = 'hrga.hrga6.hrga2_ceklist_sanitasi';

    public function index(Request $r)
    {
        $datas = DB::select("SELECT month(a.tgl) as bulan,year(a.tgl) as tahun,b.lokasi,b.id as id_lokasi FROM sanitasi as a
        left join lokasi as b on b.id = a.id_lokasi group BY month(a.tgl),b.lokasi");
        $data = [
            'title' => 'Ceklis Sanitasi',
            'datas' => $datas
        ];
        return view($this->view . '.index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Ceklis Sanitasi'
        ];
        return view($this->view . '.add', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Ceklis Sanitasi'
        ];
        return view($this->view . '.create', $data);
    }

    public function print(Request $r)
    {
        $datas = DB::table('sanitasi as a')
            ->leftJoin('item_pembersihan as b', 'b.id_item', '=', 'a.id_item')
            ->where('a.id_lokasi', $r->id_lokasi)
            ->whereMonth('a.tgl', $r->bulan)
            ->groupBy('a.id_item')
            ->selectRaw('a.id_item, b.nama_item,a.tgl,a.paraf_petugas,a.verifikator')
            ->get();

        $daysInMonth = Carbon::create(2023, $r->bulan)->daysInMonth;
        $area = DB::table('lokasi')->where('id', $r->id_lokasi)->first()->lokasi;
        $nm_bulan = DB::table('bulan')->where('id_bulan', $r->bulan)->first()->nm_bulan;

        $data = [
            'title' => 'CEKLIST SANITASI',
            'dok' => 'FRM.HRGA.06.02, Rev.00',
            'itemSanitasi' => $datas,
            'daysInMonth' => $daysInMonth,
            'id_lokasi' => $r->id_lokasi,
            'bulan' => $r->bulan,
            'area' => $area,
            'nm_bulan' => $nm_bulan,
            
        ];
        return view($this->view . '.print', $data);
    }
}

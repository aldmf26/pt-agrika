<?php

namespace App\Http\Controllers\Hrga\Hrga7PengelolaanLimbah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hrga3IdentifikasiLimbah extends Controller
{
    protected $view = 'hrga.hrga7.hrga3_identifikasi_limbah';
    public function index()
    {
        $datas = DB::select("SELECT month(a.tgl) as bulan,year(a.tgl) as tahun,a.jenis_sampah FROM hrga7_pembuangan_tps as a
        group BY month(a.tgl),a.jenis_sampah");

        $data = [
            'title' => 'Identifikasi limbah',
            'datas' => $datas
        ];
        return view("$this->view.index", $data);

    }

    public function print()
    {
        $limbah = DB::table('hrga7_identifikasi_limbah')->orderBy('id', 'desc')->get();
        $title = 'IDENTIFIKASI LIMBAH';
        $dok = 'FRM.HRGA.07.03, Rev.00';
        
        return view(
            $this->view . '.print',
            compact(
                'limbah',
                'title',
                'dok'
            )
        );
    }
}

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
        $datas = DB::select("SELECT * FROM sanitasi as a 
        left join lokasi as b on b.id = a.id_lokasi
        group by a.id_lokasi, a.bulan, a.tahun");
        $data = [
            'title' => 'Ceklis Sanitasi',
            'datas' => $datas,
            'bulan' => DB::table('bulan')->get(),
            'lokasi' => DB::table('lokasi')->get(),
        ];
        return view($this->view . '.index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Ceklis Sanitasi',
            'lokasi' => DB::table('lokasi')->get(),
            'bulan' => DB::table('bulan')->get(),
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
        $nm_bulan = DB::table('bulan')->where('id_bulan', $r->bulan)->first()->nm_bulan;
        $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $r->bulan, $r->tahun);

        // buat array daftar hari
        $hari = [];
        for ($i = 1; $i <= $jumlah_hari; $i++) {
            $hari[] = [
                'tanggal' => $i,
                'hari' => Carbon::create($r->tahun, $r->bulan, $i)->translatedFormat('l'), // Senin, Selasa, dst
            ];
        }
        $data = [
            'title' => 'CHECKLIST SANITASI',
            'dok' => 'Dok.No.: FRM.HRGA.06.02, Rev.00',
            'nm_bulan' => $nm_bulan,
            'lokasi' => DB::table('lokasi')->where('id', $r->id_lokasi)->first(),
            'bulan' => $r->bulan,
            'tahun' => $r->tahun,
            'hari' => $hari,
            'sanitasi' => DB::table('sanitasi')->where('id_lokasi', $r->id_lokasi)->where('bulan', $r->bulan)->where('tahun', $r->tahun)->get(),

        ];
        return view($this->view . '.print', $data);
    }

    public function store(Request $r)
    {
        $id_lokasi = $r->id_lokasi;
        $bulan = $r->bulan;
        $tahun = date('Y');

        if ($r->items) {
            foreach ($r->items as $key => $value) {
                $data = [
                    'id_lokasi' => $id_lokasi,
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                    'item' => $value,
                ];
                DB::table('sanitasi')->insert($data);
            }
        }

        return redirect()->route('hrga6.2.index')->with('success', 'Data Berhasil Disimpan');
    }
}

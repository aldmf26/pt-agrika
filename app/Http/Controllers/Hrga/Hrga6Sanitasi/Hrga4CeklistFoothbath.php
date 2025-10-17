<?php

namespace App\Http\Controllers\Hrga\Hrga6Sanitasi;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hrga4CeklistFoothbath extends Controller
{
    protected $view = 'hrga.hrga6.hrga4_ceklis_foothbath';

    public function index(Request $r)
    {
        $datas = DB::table('checklis_footbath')->leftJoin('lokasi', 'lokasi.id', '=', 'checklis_footbath.lokasi_id')
            ->select('checklis_footbath.*', 'lokasi.lokasi')
            ->get();

        $data = [
            'title' => 'Cheklist Footbath',
            'datas' => $datas,
            'bulan' => DB::table('bulan')->get(),
            'lokasi' => DB::table('lokasi')->get(),
        ];
        return view($this->view . '.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Ceklis Foothbath'
        ];
        return view($this->view . '.create', $data);
    }

    public function print(Request $r)
    {
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
            'title' => 'Footh Bath',
            'dok' => 'Dok.No.: FRM.HRGA.06.03, Rev.01',
            'nm_bulan' => Carbon::createFromFormat('m', $r->bulan)->format('F'),
            'tahun' => $r->tahun,
            'bulan' => $r->bulan,
            'lokasi' => DB::table('lokasi')->where('id', $r->lokasi_id)->first(),
            'hari' => $hari,
            'sanitasi' => DB::table('checklis_footbath')
                ->where('id', $r->id)
                ->get(),

        ];
        return view($this->view . '.print', $data);
    }

    public function store(Request $r)
    {

        for ($i = 0; $i < count($r->item); $i++) {
            DB::table('checklis_footbath')
                ->where('bulan', $r->bulan[$i])
                ->where('tahun', date('Y'))
                ->where('lokasi_id', $r->lokasi_id[$i])
                ->where('item', $r->item[$i])
                ->delete();
            DB::table('checklis_footbath')->insert([
                'item' => $r->item[$i],
                'lokasi_id' => $r->lokasi_id[$i],
                'bulan' => $r->bulan[$i],
                'tahun' => date('Y'),
            ]);
        }
        return redirect()->route('hrga6.4.index')->with('success', 'Data Berhasil Disimpan');
    }
}

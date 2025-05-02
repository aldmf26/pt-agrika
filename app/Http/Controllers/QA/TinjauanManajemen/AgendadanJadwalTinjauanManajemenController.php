<?php

namespace App\Http\Controllers\QA\TinjauanManajemen;

use App\Http\Controllers\Controller;
use App\Models\AgendadanJadwalTinjauanManajemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgendadanJadwalTinjauanManajemenController extends Controller
{
    public function index()
    {
        $agenda = DB::select("SELECT id, id as id_agenda, dari_jam, sampai_jam,agenda,pic FROM agenda");
        $agenda2 = AgendadanJadwalTinjauanManajemen::selectRaw('tanggal, COUNT(*) as jumlah_agenda')
            ->groupBy('tanggal')
            ->get();
        $data = [
            'title' => 'Agenda dan Jadwal Tinjauan Manajemen',
            'agenda' => $agenda,
            'agenda2' => $agenda2,
        ];
        return view('qa.tinjauan_manajemen.agendadan_jadwal_tinjauan_manajemen.index', $data);
    }

    public function store(Request $r)
    {
        $agenda = AgendadanJadwalTinjauanManajemen::where('tanggal', $r->tanggal)->delete();

        for ($i = 0; $i < count($r->agenda); $i++) {
            if (empty($r->id[$i])) {
                $data = [
                    'dari_jam' => $r->waktu_dari,
                    'sampai_jam' => $r->waktu_dari,
                    'agenda' => $r->agenda[$i],
                    'pic' => $r->pic[$i],
                ];
                DB::table('agenda')->insert($data);
            } else {
                $data = [
                    'dari_jam' => $r->waktu_dari,
                    'sampai_jam' => $r->waktu_dari,
                    'agenda' => $r->agenda[$i],
                    'pic' => $r->pic[$i],
                ];
                DB::table('agenda')->where('id', $r->id[$i])->update($data);
            }

            $data2 = [
                'tanggal' => $r->tanggal,
                'dari_jam' => $r->waktu_dari,
                'sampai_jam' => $r->waktu_dari,
                'agenda' => $r->agenda[$i],
                'pic' => $r->pic[$i],
            ];
            AgendadanJadwalTinjauanManajemen::create($data2);
        }

        return redirect()->route('qa.agendadan_jadwal_tinjauan_manajemen.index')->with('sukses', 'Data Berhasil Disimpan');
    }

    public function print(Request $r)
    {
        $data = [
            'title' => 'Agenda dan Jadwal Tinjauan Manajemen',
            'agenda' => AgendadanJadwalTinjauanManajemen::where('tanggal', $r->tanggal)->get(),
            'tanggal' => $r->tanggal,
        ];
        return view('qa.tinjauan_manajemen.agendadan_jadwal_tinjauan_manajemen.print', $data);
    }
}

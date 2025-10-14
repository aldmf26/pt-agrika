<?php

namespace App\Http\Controllers\QA\TinjauanManajemen;

use App\Http\Controllers\Controller;
use App\Models\AgendadanJadwalTinjauanManajemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AgendadanJadwalTinjauanManajemenController extends Controller
{
    public function index()
    {
        $agenda = DB::select("SELECT id, id as id_agenda, dari_jam, sampai_jam,agenda,pic FROM agenda");
        $agenda2 = AgendadanJadwalTinjauanManajemen::select(
            'agendadan_jadwal_tinjauan_manajemens.tanggal',
            'agendadan_jadwal_tinjauan_manajemens.dari_jam',
            'agendadan_jadwal_tinjauan_manajemens.sampai_jam',
            DB::raw("GROUP_CONCAT(DISTINCT agendadan_jadwal_tinjauan_manajemens.agenda SEPARATOR '||') as agendas"),
            DB::raw("GROUP_CONCAT(DISTINCT data_pegawais.nama SEPARATOR ', ') as pics")
        )
            ->leftJoin('daftar_hadir', function ($join) {
                $join->on(
                    DB::raw("daftar_hadir.nota_agenda COLLATE utf8mb4_unicode_ci"),
                    '=',
                    DB::raw("agendadan_jadwal_tinjauan_manajemens.nota_agenda COLLATE utf8mb4_unicode_ci")
                );
            })
            ->leftJoin('data_pegawais', 'data_pegawais.id', '=', 'daftar_hadir.pegawai_id')
            ->groupBy('agendadan_jadwal_tinjauan_manajemens.nota_agenda')
            ->orderBy('agendadan_jadwal_tinjauan_manajemens.created_at', 'desc')
            ->get();




        $pegawai = DB::table('data_pegawais')->whereIn('posisi', ['Pengawas', 'Staf Admin'])->get();
        $data = [
            'title' => 'Agenda dan Jadwal Tinjauan Manajemen',
            'agenda' => $agenda,
            'agenda2' => $agenda2,
            'pegawai' => $pegawai,
        ];
        return view('qa.tinjauan_manajemen.agendadan_jadwal_tinjauan_manajemen.index', $data);
    }

    public function store(Request $r)
    {
        $agenda = AgendadanJadwalTinjauanManajemen::where('tanggal', $r->tanggal)->delete();
        $nota = Str::random(10);

        for ($i = 0; $i < count($r->agenda); $i++) {
            if (empty($r->id[$i])) {
                $data = [
                    'dari_jam' => $r->waktu_dari,
                    'sampai_jam' => $r->waktu_sampai,
                    'agenda' => $r->agenda[$i],
                ];
                DB::table('agenda')->insert($data);
            } else {
                $data = [
                    'dari_jam' => $r->waktu_dari,
                    'sampai_jam' => $r->waktu_sampai,
                    'agenda' => $r->agenda[$i],
                ];
                DB::table('agenda')->where('id', $r->id[$i])->update($data);
            }

            $data2 = [
                'tanggal' => $r->tanggal,
                'dari_jam' => $r->waktu_dari,
                'sampai_jam' => $r->waktu_sampai,
                'agenda' => $r->agenda[$i],
                'nota_agenda' => $nota,
            ];
            AgendadanJadwalTinjauanManajemen::create($data2);
        }

        for ($i = 0; $i < count($r->pic); $i++) {
            $data3 = [
                'nota_agenda' => $nota,
                'pegawai_id' => $r->pic[$i],
            ];
            DB::table('daftar_hadir')->insert($data3);
        }

        return redirect()->route('qa.agendadan_jadwal_tinjauan_manajemen.index')->with('sukses', 'Data Berhasil Disimpan');
    }

    public function print(Request $r)
    {
        $agenda2 = AgendadanJadwalTinjauanManajemen::select(
            'agendadan_jadwal_tinjauan_manajemens.tanggal',
            'agendadan_jadwal_tinjauan_manajemens.dari_jam',
            'agendadan_jadwal_tinjauan_manajemens.sampai_jam',
            DB::raw("GROUP_CONCAT(DISTINCT agendadan_jadwal_tinjauan_manajemens.agenda SEPARATOR '||') as agendas"),
            DB::raw("GROUP_CONCAT(DISTINCT data_pegawais.nama SEPARATOR ', ') as pics")
        )
            ->leftJoin('daftar_hadir', function ($join) {
                $join->on(
                    DB::raw("daftar_hadir.nota_agenda COLLATE utf8mb4_unicode_ci"),
                    '=',
                    DB::raw("agendadan_jadwal_tinjauan_manajemens.nota_agenda COLLATE utf8mb4_unicode_ci")
                );
            })
            ->leftJoin('data_pegawais', 'data_pegawais.id', '=', 'daftar_hadir.pegawai_id')
            ->where('agendadan_jadwal_tinjauan_manajemens.tanggal', $r->tanggal)
            ->groupBy('agendadan_jadwal_tinjauan_manajemens.nota_agenda')
            ->latest()
            ->get();
        $data = [
            'title' => 'Agenda dan Jadwal Tinjauan Manajemen',
            'agenda' => $agenda2,
            'tanggal' => $r->tanggal,
        ];
        return view('qa.tinjauan_manajemen.agendadan_jadwal_tinjauan_manajemen.print', $data);
    }


    public function tambah_baris(Request $r)
    {
        $pegawai = DB::table('data_pegawais')->whereIn('posisi', ['Pengawas', 'Staf Admin'])->get();
        $data = [
            'count' => $r->count,
            'pegawai' => $pegawai,

        ];
        return view('qa.tinjauan_manajemen.agendadan_jadwal_tinjauan_manajemen.tambah_baris', $data);
    }
}

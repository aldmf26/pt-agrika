<?php

namespace App\Http\Controllers\QA\TinjauanManajemen;

use App\Http\Controllers\Controller;
use App\Models\AgendadanJadwalTinjauanManajemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarhadirTinjuanManajemenController extends Controller
{
    public function index(Request $r)
    {
        $tanggal = empty($r->tanggal) ? date('Y-m-d') : $r->tanggal;
        $agenda2 = AgendadanJadwalTinjauanManajemen::select(
            'agendadan_jadwal_tinjauan_manajemens.tanggal',
            'agendadan_jadwal_tinjauan_manajemens.dari_jam',
            'agendadan_jadwal_tinjauan_manajemens.sampai_jam',
            'agendadan_jadwal_tinjauan_manajemens.nota_agenda',
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
            ->get();
        $data = [
            'title' => 'Daftar Hadir Tinjauan Manajemen',
            'agenda' => $agenda2,
            'pegawai' => DB::select("SELECT * FROM data_pegawais as a where a.posisi in ('Staf Admin','pengawas') order by a.nama asc"),
            'tanggal' => $tanggal
        ];
        return view('qa.tinjauan_manajemen.daftar_hadir_tinjauan_manajemen.index', $data);
    }

    public function print(Request $r)
    {

        $agenda = DB::table('daftar_hadir')
            ->leftJoin('data_pegawais', 'data_pegawais.id', '=', 'daftar_hadir.pegawai_id')
            ->where('nota_agenda', $r->nota_agenda)->get();

        $data = [
            'title' => 'Daftar Hadir Tinjauan Manajemen',
            'agenda' => $agenda,
            'tanggal' => $r->tanggal,


        ];
        return view('qa.tinjauan_manajemen.daftar_hadir_tinjauan_manajemen.print', $data);
    }
}

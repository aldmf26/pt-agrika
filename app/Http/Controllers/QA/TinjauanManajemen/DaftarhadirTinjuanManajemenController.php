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
        $agenda = AgendadanJadwalTinjauanManajemen::selectRaw('tanggal, COUNT(*) as jumlah_agenda')
            ->groupBy('tanggal')
            ->get();
        $data = [
            'title' => 'Daftar Hadir Tinjauan Manajemen',
            'agenda' => $agenda,
            'pegawai' => DB::select("SELECT * FROM data_pegawais as a where a.posisi in ('Staf Admin','pengawas') order by a.nama asc"),
            'tanggal' => $tanggal
        ];
        return view('qa.tinjauan_manajemen.daftar_hadir_tinjauan_manajemen.index', $data);
    }

    public function print(Request $r)
    {
        $tanggal = empty($r->tanggal) ? date('Y-m-d') : $r->tanggal;
        $agenda = AgendadanJadwalTinjauanManajemen::selectRaw('tanggal, COUNT(*) as jumlah_agenda')
            ->groupBy('tanggal')
            ->get();
        $data = [
            'title' => 'Daftar Hadir Tinjauan Manajemen',
            'agenda' => $agenda,
            'pegawai' => DB::select("SELECT * FROM data_pegawais as a where a.posisi in ('Staf Admin','pengawas') order by a.nama asc"),
            'tanggal' => $tanggal
        ];
        return view('qa.tinjauan_manajemen.daftar_hadir_tinjauan_manajemen.print', $data);
    }
}

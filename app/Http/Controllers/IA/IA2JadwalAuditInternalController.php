<?php

namespace App\Http\Controllers\IA;

use App\Http\Controllers\Controller;
use App\Models\DataPegawai;
use App\Models\JadwalAuditInternal;
use App\Models\ProgramAuditInternal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IA2JadwalAuditInternalController extends Controller
{
    public function index()
    {
        $datas = JadwalAuditInternal::selectraw('tgl')->groupby('tgl')->orderBy('tgl', 'desc')->get();
        $data = [
            'title' => 'Jadwal Audit Internal',
            'datas' => $datas
        ];

        return view('ia.ia2_jadwal_audit_internal.index', $data);
    }

    public function create()
    {
        $bagian = ProgramAuditInternal::where('tahun', date('Y'))->get()->pluck('departemen');
        $pegawai = DataPegawai::karyawan()->get()->pluck('nama');
        $data = [
            'title' => 'Tambah Jadwal Audit Internal',
            'bagian' => $bagian,
            'pegawai' => $pegawai
        ];


        return view('ia.ia2_jadwal_audit_internal.create', $data);
    }

    public function store(Request $r)
    {
        try {
            DB::beginTransaction();
            foreach ($r->bagian as $key => $bagian) {
                // Skip jika key adalah lunch break (7)
                if ($key == 7) continue;

                // Skip jika semua field kosong
                if (
                    empty($bagian) &&
                    empty($r->proses[$key]) &&
                    empty($r->auditor[$key]) &&
                    empty($r->auditee[$key])
                ) {
                    continue;
                }
                $cek = JadwalAuditInternal::where('tgl', $r->tgl)
                    ->where('waktu', $r->waktu[$key])
                    ->first();

                if ($cek) {
                    continue; // lewati slot ini, jangan hentikan semua insert
                }

                JadwalAuditInternal::create([
                    'tgl' => $r->tgl,
                    'waktu' => $r->waktu[$key],
                    'bagian' => $bagian,
                    'proses' => $r->proses[$key],
                    'auditor' => $r->auditor[$key],
                    'audite' => $r->auditee[$key],
                    'admin' => auth()->user()->name
                ]);
            }

            DB::commit();
            return redirect()->route('ia.2.index')->with('sukses', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function edit($tgl)
    {
        $bagian = ProgramAuditInternal::where('tahun', date('Y'))->get()->pluck('departemen');
        $pegawai = DataPegawai::karyawan()->get()->pluck('nama');
        $data = [
            'title' => 'Edit Jadwal Audit Internal',
            'tgl' => $tgl,
            'bagian' => $bagian,
            'pegawai' => $pegawai,
        ];

        return view('ia.ia2_jadwal_audit_internal.edit', $data);
    }

    public function update(Request $r, $tgl)
    {
        try {
            DB::beginTransaction();
            // Hapus data lama untuk tanggal tersebut
            JadwalAuditInternal::where('tgl', $tgl)->delete();
            foreach ($r->bagian as $key => $bagian) {
                // Skip jika key adalah lunch break (7)
                if ($key == 7) continue;

                // Skip jika semua field kosong
                if (
                    empty($bagian) &&
                    empty($r->proses[$key]) &&
                    empty($r->auditor[$key]) &&
                    empty($r->auditee[$key])
                ) {
                    continue;
                }

                JadwalAuditInternal::create([
                    'tgl' => $r->tgl,
                    'waktu' => $r->waktu[$key],
                    'bagian' => $bagian,
                    'proses' => $r->proses[$key],
                    'auditor' => $r->auditor[$key],
                    'audite' => $r->auditee[$key],
                    'admin' => auth()->user()->name
                ]);
            }

            DB::commit();
            return redirect()->route('ia.2.index')->with('sukses', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($tgl)
    {
        try {
            JadwalAuditInternal::where('tgl', $tgl)->delete();
            return redirect()->route('ia.2.index')->with('sukses', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function print($tgl)
    {
        $datas = JadwalAuditInternal::where('tgl', $tgl)->orderBy('waktu', 'asc')->get();
        $data = [
            'title' => 'JADWAL AUDIT INTERNAL',
            'dok' => 'Dok.No.: FRM.IA.01.02, Rev.00',
            'tgl' => $tgl,
            'datas' => $datas
        ];

        return view('ia.ia2_jadwal_audit_internal.print', $data);
    }
}

<?php

namespace App\Http\Controllers\IA;

use App\Http\Controllers\Controller;
use App\Models\JadwalAuditInternal;
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
        $data = [
            'title' => 'Tambah Jadwal Audit Internal',
        ];

        return view('ia.ia2_jadwal_audit_internal.create', $data);
    }

    public function store(Request $r)
    {
        dd($r->all());
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
                $cek = JadwalAuditInternal::where('tgl', $r->tgl)->first();
                if ($cek) {
                    return redirect()->back()->with('error', 'Tanggal <strong>' . $r->tgl . '</strong> sudah ada');
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
        $data = [
            'title' => 'Edit Jadwal Audit Internal',
            'tgl' => $tgl
        ];

        return view('ia.ia2_jadwal_audit_internal.edit', $data);
    }
    public function print($tgl)
    {
        $data = [
            'title' => 'JADWAL AUDIT INTERNAL',
            'dok' => 'Dok.No.: FRM.AI.01.02, Rev.00',
            'tgl' => $tgl
        ];

        return view('ia.ia2_jadwal_audit_internal.print', $data);
    }
}

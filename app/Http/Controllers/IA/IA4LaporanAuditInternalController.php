<?php

namespace App\Http\Controllers\IA;

use App\Http\Controllers\Controller;
use App\Models\DataPegawai;
use App\Models\Divisi;
use App\Models\LaporanAuditInternal;
use Illuminate\Http\Request;

class IA4LaporanAuditInternalController extends Controller
{
    public function index()
    {
        $datas = LaporanAuditInternal::get();
        $data = [
            'title' => 'Summary Logsheet Finding Audit Internal',
            'datas' => $datas,
        ];

        return view('ia.ia4_laporan_audit_internal.index', $data);
    }

    public function create()
    {
        $user = DataPegawai::karyawan()->get();
        $urutan = LaporanAuditInternal::latest()->count() + 1;
        $divisi = Divisi::get();
        $data = [
            'title' => 'Tambah Laporan Audit Internal',
            'urutan' => $urutan,
            'user' => $user,
            'divisi' => $divisi,
        ];

        return view('ia.ia4_laporan_audit_internal.create', $data);
    }

    public function store(Request $r)
    {
        $urutan = LaporanAuditInternal::latest()->count() + 1;
        $tindakan = "Perbaikan : $r->perbaikan" . "\n\n" . "Pencegahan : $r->pencegahan";
        LaporanAuditInternal::create(
            [
                'urutan' => $urutan,
                'divisi' => $r->divisi,
                'tgl_audit' => $r->tgl_audit,
                'tindakan' => $tindakan,
                'finding' => $r->finding,
                'audite' => $r->audite,
                'pic' => $r->pic,
                'completion_date' => $r->completion_date,
                'status' => $r->status,
                'admin' => auth()->user()->name
            ]
        );

        return redirect()->route('ia.4.index')->with('sukses', 'Data Berhasil disimpan');
    }
    public function edit(LaporanAuditInternal $laporan)
    {
        $user = DataPegawai::karyawan()->get();
        $data = [
            'title' => 'Edit Laporan Audit Internal',
            'laporan' => $laporan,
            'user' => $user,
        ];

        return view('ia.ia4_laporan_audit_internal.edit', $data);
    }

    public function update(Request $r, LaporanAuditInternal $laporan)
    {
        $tindakan = "Perbaikan : $r->perbaikan" . "\n\n" . "Pencegahan : $r->pencegahan";

        $laporan->update([
            'divisi' => $r->divisi,
            'tgl_audit' => $r->tgl_audit,
            'tindakan' => $tindakan,
            'finding' => $r->finding,
            'audite' => $r->audite,
            'pic' => $r->pic,
            'completion_date' => $r->completion_date,
            'status' => $r->status,
        ]);

        return redirect()->route('ia.4.index')->with('sukses', 'Data Berhasil diupdate');
    }

    public function destroy($id)
    {
        $laporan = LaporanAuditInternal::findOrFail($id);
        $laporan->delete();

        return redirect()->route('ia.4.index')->with('sukses', 'Data Berhasil dihapus');
    }
    public function print()
    {
        $laporan = LaporanAuditInternal::get();
        $data = [
            'title' => 'SUMMARY & LOGSHEET FINDING AUDIT INTERNAL',
            'dok' => 'Dok.No.: FRM.IA.01.04, Rev.00',
            'laporan' => $laporan
        ];

        return view('ia.ia4_laporan_audit_internal.print', $data);
    }
}

<?php

namespace App\Http\Controllers\IA;

use App\Http\Controllers\Controller;
use App\Models\LaporanAuditInternal;
use Illuminate\Http\Request;

class IA4LaporanAuditInternalController extends Controller
{
    public function index()
    {
        $datas = LaporanAuditInternal::selectRaw('tgl_audit, departemen, COUNT(*) as count')
            ->groupBy(['tgl_audit', 'departemen'])
            ->get();
        $data = [
            'title' => 'laporan Audit Internal',
            'datas' => $datas
        ];

        return view('ia.ia4_laporan_audit_internal.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Laporan Audit Internal',
        ];

        return view('ia.ia4_laporan_audit_internal.create', $data);
    }

    public function store(Request $r)
    {
        LaporanAuditInternal::create(
            [
                'departemen' => $r->departemen,
                'tgl_audit' => $r->tgl_audit,
                'no_ftp' => $r->no_ftpp,
                'auditor' => $r->auditor,
                'laporan_audit' => "$r->laporan_audit",
                'audite' => $r->auditee,
                'admin' => auth()->user()->name
            ]
        );
        
        return redirect()->route('ia.4.index')->with('sukses', 'Data Berhasil disimpan');
    }
    public function edit($tgl)
    {
        $data = [
            'title' => 'Edit Laporan Audit Internal',
            'tgl' => $tgl
        ];

        return view('ia.ia4_laporan_audit_internal.edit', $data);
    }
    public function print(Request $r)
    {
        $datas = LaporanAuditInternal::where([['tgl_audit', $r->tgl],['departemen', $r->departemen]])->get();
        $data = [
            'title' => 'LAPORAN AUDIT INTERNAL',
            'dok' => 'Dok.No.: FRM.AI.01.04, Rev.00',
            'datas' => $datas
        ];

        return view('ia.ia4_laporan_audit_internal.print', $data);
    }
}

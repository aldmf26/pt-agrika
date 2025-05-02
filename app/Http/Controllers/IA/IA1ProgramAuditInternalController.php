<?php

namespace App\Http\Controllers\IA;

use App\Http\Controllers\Controller;
use App\Models\ProgramAuditInternal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IA1ProgramAuditInternalController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Program Audit Internal'
        ];

        return view('ia.ia1_program_audit_internal.index', $data);
    }

    public function print(Request $r)
    {
        $datas = ProgramAuditInternal::where('tahun', $r->tahun)->get();

        $datas = [
            'title' => 'PROGRAM AUDIT INTERNAL',
            'dok' => 'Dok.No.: FRM.AI.01.01, Rev.00',
            'tahun' => $r->tahun,
            'datas' => $datas
        ];
        return view("ia.ia1_program_audit_internal.print", $datas);
    }

    public function audit(Request $r)
    {
        $data = [
            'title' => 'Program Audit Internal',
            'datas' => ProgramAuditInternal::find($r->id)->first(),
            'bulan' => DB::table('bulan')->where('bulan', $r->bulan)->first()
        ];
        return view("ia.ia1_program_audit_internal.audit", $data);
    }
}

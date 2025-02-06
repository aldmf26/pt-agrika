<?php

namespace App\Http\Controllers\IA;

use App\Http\Controllers\Controller;
use App\Models\LaporanAuditInternal;
use Illuminate\Http\Request;

class IA4LaporanAuditInternalController extends Controller
{
    public function index()
    {
        $datas = LaporanAuditInternal::get();
        $data = [
            'title' => 'laporan Audit Internal',
            'datas' => $datas
        ];

        return view('ia.ia4_laporan_audit_internal.index', $data);
    }
}

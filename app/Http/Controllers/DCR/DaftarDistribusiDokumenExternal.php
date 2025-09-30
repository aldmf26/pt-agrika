<?php

namespace App\Http\Controllers\DCR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarDistribusiDokumenExternal extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Induk Dokumen Eksternal',
            'daftar' => DB::table('daftar_induk_dokumen_eksternal')->get()
        ];
        return view('dcr.daftar_distibusi_dokumen_eksternal.index', $data);
    }
    public function print()
    {
        $data = [
            'title' => 'DAFTAR DISTRIBUSI DOKUMEN EKSTERNAL',
            'dok' => 'Dok.No.: FRM.DCR.01.05, Rev.00',
            'daftar' => DB::table('daftar_induk_dokumen_eksternal')->orderBy('id', 'asc')->get()
        ];

        return view('dcr.daftar_distibusi_dokumen_eksternal.print', $data);
    }
}

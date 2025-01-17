<?php

namespace App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Hrga4DataPegawai extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Hrga 1.4 data pegawai'
        ];
        return view('hrga.hrga1.hrga1_data_pegawai.index',$data);
    }
}

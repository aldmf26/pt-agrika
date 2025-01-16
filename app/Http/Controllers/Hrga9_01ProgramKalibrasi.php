<?php

namespace App\Http\Controllers;

use App\Models\hrga9_1KalibrasiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hrga9_01ProgramKalibrasi extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'FRM.HRGA.09.01 - PROGRAM KALIBRASI SARANA PEMANTAUAN DAN PENGUKURAN',
            'program' => hrga9_1KalibrasiModel::all(),
            'bulan' => DB::table('bulan')->get()

        ];
        return view('hrga.hrga9.hrga9_1', $data);
    }
}

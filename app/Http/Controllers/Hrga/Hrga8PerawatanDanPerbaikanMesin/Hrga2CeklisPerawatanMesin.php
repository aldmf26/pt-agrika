<?php

namespace App\Http\Controllers\Hrga\Hrga8PerawatanDanPerbaikanMesin;

use App\Http\Controllers\Controller;
use App\Models\ItemMesin;
use App\Models\ProgramPerawatanMesin;
use Illuminate\Http\Request;

class Hrga2CeklisPerawatanMesin extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Checklist perawatan mesin'
        ];
        return view('hrga.hrga8.hrga2_ceklist_perawatan_mesin.index', $data);
    }

    public function add(Request $r)
    {
        $data = [
            'title' => 'Tambah checklist perawatan mesin',
            'mesin' => ProgramPerawatanMesin::where('id', $r->id)->first(),
            'bulan' => $r->bulan,
            'tahun' => $r->tahun
        ];
        return view('hrga.hrga8.hrga2_ceklist_perawatan_mesin.add', $data);
    }
}

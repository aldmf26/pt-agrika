<?php

namespace App\Http\Controllers\Hrga\Hrga8PerawatanDanPerbaikanMesin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Hrga2CeklisPerawatanMesin extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Ceklust Perawatan Mesin'
        ];
        return view('hrga.hrga8.hrga2_ceklist_perawatan_mesin.index', $data);
    }
}

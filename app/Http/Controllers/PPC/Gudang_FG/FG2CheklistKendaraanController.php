<?php

namespace App\Http\Controllers\PPC\Gudang_FG;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FG2CheklistKendaraanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Cheklist Kendaraan'
        ];
        return view('ppc.gudang_fg.checklist_kendaraan.index', $data);
    }
}

<?php

namespace App\Http\Controllers\Hrga\Hrga5PerbaikandanPerawatanSaranaPrasarana;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Hrga1ProgramPerawatanSaranadanPrasaranaUmum extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Program Perawatan Sarana dan Prasarana Umum',
        ];
        return view('hrga.hrga5.hrga1_programperawatansarana.index', $data);
    }
}

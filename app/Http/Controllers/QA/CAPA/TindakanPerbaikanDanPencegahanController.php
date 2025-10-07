<?php

namespace App\Http\Controllers\QA\CAPA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TindakanPerbaikanDanPencegahanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Tindakan Perbaikan dan Pencegahan',
        ];

        return view('qa.capa.tindakan_perbaikan_dan_pencegahan.index', $data);
    }
}

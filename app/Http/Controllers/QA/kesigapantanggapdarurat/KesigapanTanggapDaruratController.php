<?php

namespace App\Http\Controllers\qa\kesigapantanggapdarurat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KesigapanTanggapDaruratController extends Controller
{
    public function index()
    {
        return view('qa.kesigapantanggapdarurat.index');
    }
}

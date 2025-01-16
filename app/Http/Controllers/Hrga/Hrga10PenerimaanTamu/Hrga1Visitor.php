<?php

namespace App\Http\Controllers\Hrga\Hrga10PenerimaanTamu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Hrga1Visitor extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Hrga 10.1 VISITOR HEALTH MONITORING FORM'
        ];
        return view('hrga.hrga10.hrga1_visitor.index',$data);
    }
}

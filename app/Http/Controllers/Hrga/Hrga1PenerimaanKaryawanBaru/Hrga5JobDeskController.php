<?php

namespace App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Hrga5JobDeskController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Job Desk',
            'description' => 'Halaman untuk mengelola job desk karyawan baru',
        ];
        return view('hrga.hrga1.hrga5_job_desk.index', $data);
    }

    public function struktur()
    {
        $data = [
            'title' => 'Struktur Organisasi',
            'description' => 'Halaman untuk mengelola job desk karyawan baru',
        ];
        return view('hrga.hrga1.hrga6_struktur.index', $data);
    }
}

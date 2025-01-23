<?php

namespace App\Http\Controllers\Hrga\Hrga10PenerimaanTamu;

use App\Http\Controllers\Controller;
use App\Models\BukuTamu;
use App\Services\TtdUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Hrga2RegistrasiTamu extends Controller
{
    protected $view = 'hrga.hrga10.hrga2_registrasi_tamu';
    public  function index()
    {
        $datas = BukuTamu::orderBy('id', 'desc')->get();
        $data = [
            'title' => 'Hrga 10.2 REGISTRASI TAMU',
            'datas' => $datas
        ];
        return view("{$this->view}.index", $data);
    }

    public  function add()
    {
        $data = [
            'title' => 'Hrga 10.2 Tambah Registrasi Tamu'
        ];
        return view("{$this->view}.add", $data);
    }

    public function store(Request $r, TtdUploadService $service)
    {
        try {
            DB::beginTransaction();

            $existingRecord = BukuTamu::where([
                ['tanggal', $r->tanggal],
                ['nama', $r->nama],
                ['time_in', $r->time_in],
            ])->first();

            if (!$existingRecord) {
                $visitorSignaturePath = $service->store($r->visitor_signature, 'visitor_signature');

                BukuTamu::create([
                    'tanggal' => $r->tanggal,
                    'nama' => $r->nama,
                    'suhu' => $r->suhu,
                    'masker' => $r->masker,
                    'alamat' => $r->alamat,
                    'nomor_kendaraan' => $r->nomor_kendaraan,
                    'keperluan' => $r->keperluan,
                    'bertemu_dengan' => $r->bertemu_dengan,
                    'time_in' => $r->jam_masuk,
                    'time_out' => $r->jam_keluar,
                    'admin' => Auth::user()->name,
                    'visitor_signature' => $visitorSignaturePath
                ]);
            }

            DB::commit();
            return redirect()->route('hrga10.2.index')->with('sukses', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function print(Request $r)
    {
        $datas = BukuTamu::orderBy('id', 'desc')->get();

        $datas = [
            'title' => 'BUKU TAMU',
            'dok' => 'FORM Buku Tamu FRM.HRGA.10.02',
            'datas' => $datas
        ];
        return view("{$this->view}.print", $datas);
    }
}

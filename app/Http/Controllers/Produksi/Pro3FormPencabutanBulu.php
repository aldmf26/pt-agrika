<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Pro3FormPencabutanBulu extends Controller
{
    public function index(Request $r)
    {
        $cabut = Http::get("https://sarang.ptagafood.com/api/apihasap/cabut_pengeringan_new");
        $cabut = json_decode($cabut, TRUE);
        $data = [
            'title' => 'Form Pencabutan Bulu',
            'cabut' => $cabut['data'],
        ];
        return view('produksi.pro3formpencabutanbulu.index', $data);
    }

    public function print(Request $r)
    {
        $cabut = Http::get("https://sarang.ptagafood.com/api/apihasap/cabut_pengeringan_new_detail?id_pengawas=$r->id_pengawas");
        $cabut = json_decode($cabut, TRUE);
        $data = [
            'title' => 'Form Pencabutan Bulu',
            'cabut' => $cabut['data'],
            'tgl' => $r->tgl,
            'pengawas' => $r->pengawas
        ];
        return view('produksi.pro3formpencabutanbulu.print', $data);
    }

    public function edit(Request $request)
    {
        try {
            $data = $request->validate([
                'no_box' => 'required',
                'tgl' => 'required|date',
                'waktu_mulai_drying' => 'nullable',
                'waktu_selesai_drying' => 'nullable',
                'keterangan' => 'nullable|string',
            ]);

            DB::table('form_pros_01_02_edit')->updateOrInsert(
                [
                    'no_box' => $data['no_box'],
                    'tgl' => $data['tgl'],
                ],
                [
                    'waktu_mulai_drying' => $data['waktu_mulai_drying'],
                    'waktu_selesai_drying' => $data['waktu_selesai_drying'],
                    'keterangan' => $data['keterangan'],

                ]
            );

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}

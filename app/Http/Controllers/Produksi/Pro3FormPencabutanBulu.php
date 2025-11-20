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
        // Ambil data utama dari API
        $cabut = Http::get("https://sarang.ptagafood.com/api/apihasap/cabut_pengeringan_new_detail?id_pengawas=$r->id_pengawas")
            ->json()['data'] ?? [];

        if (!$cabut) {
            return "Data API kosong";
        }

        // --- 1. Ambil semua nm_partai unik untuk sbw_kotor ---
        $nmPartaiList = collect($cabut)->pluck('nm_partai')->unique()->toArray();

        $sbwList = DB::table('sbw_kotor')
            ->leftJoin('grade_sbw_kotor', 'sbw_kotor.grade_id', '=', 'grade_sbw_kotor.id')
            ->where(function ($q) use ($nmPartaiList) {
                foreach ($nmPartaiList as $nm) {
                    $q->orWhere('nm_partai', 'like', '%' . $nm . '%');
                }
            })
            ->select(
                'sbw_kotor.*',
                'grade_sbw_kotor.nama as grade_nama',
                'sbw_kotor.no_invoice'
            )
            ->get()
            ->groupBy('nm_partai');


        // --- 2. Ambil semua no_box + tgl untuk edit ---
        $editKeys = collect($cabut)->map(function ($c) {
            return $c['no_box'] . '|' . $c['tgl'];
        });

        $editList = DB::table('form_pros_01_02_edit')
            ->whereIn(DB::raw("CONCAT(no_box, '|', tgl)"), $editKeys)
            ->get()
            ->keyBy(function ($row) {
                return $row->no_box . '|' . $row->tgl;
            });


        // --- 3. Gabungkan data ke masing-masing item cabut ---
        $cabut = collect($cabut)->map(function ($c) use ($sbwList, $editList) {

            // sbw_kotor matching
            $sbw = null;

            if (isset($sbwList[$c['nm_partai']])) {
                $sbw = $sbwList[$c['nm_partai']]->first();
            }

            // edit matching
            $editKey = $c['no_box'] . '|' . $c['tgl'];
            $edit = $editList[$editKey] ?? null;

            // Tambahkan ke item (tanpa mengubah struktur)
            $c['sbw'] = $sbw;
            $c['edit'] = $edit;

            return $c;
        });

        // kirim ke blade
        return view('produksi.pro3formpencabutanbulu.print', [
            'title' => 'Form Pencabutan Bulu',
            'cabut' => $cabut,
            'tgl' => $r->tgl,
            'pengawas' => $r->pengawas
        ]);
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

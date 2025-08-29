<?php

namespace App\Http\Controllers\QA\Recall;

use App\Http\Controllers\Controller;
use App\Models\DataPegawai;
use App\Models\Recall;
use App\Models\RecallProduct;
use App\Models\RecallTeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InformasiRecallProdukController extends Controller
{
    public function index()
    {
        $data  = [
            'title' => 'Informasi Recall Produk',
            'recalls' => Recall::with(['products', 'teamMembers'])->latest()->get(),
        ];
        return view('qa.recall.informasi_recall_produk.index', $data);
    }

    public function create()
    {
        $sbw = DB::select("SELECT a.id,b.nama,a.no_invoice as no_lot FROM `sbw_kotor` as a
                join grade_sbw_kotor as b on a.grade_id = b.id");

        $data  = [
            'title' => 'Tambah Informasi Recall Produk',
            'namas' => DataPegawai::karyawan()->get(),
            'sbw' => $sbw,
        ];
        return view('qa.recall.informasi_recall_produk.create', $data);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // 1. Simpan data utama recall
            $lastNota = Recall::orderByDesc('no_nota')->value('no_nota');
            $no_nota = $lastNota ? $lastNota + 1 : 1001;
            $recall = Recall::create([
                'no_nota' => $no_nota,
                'skenario_recall' => $request->skenario,
                'dibuat_oleh' => auth()->user()->name, // jika ada user login
            ]);

            for ($i = 0; $i < count($request->nama); $i++) {
                RecallTeamMember::create([
                    'recall_id' => $recall->id,
                    'nama' => $request->nama[$i],
                    'tugas' => $request->tugas[$i],
                ]);
            }

            for ($i = 0; $i < count($request->nama_produk); $i++) {
                RecallProduct::create([
                    'recall_id' => $recall->id,
                    'nama' => $request->nama_produk[$i],
                    'no_lot' => $request->no_lot[$i],
                    'jumlah_recall' => $request->jumlah_recall[$i],
                    'jumlah_distribusi' => $request->jumlah_distribusi[$i],
                    'nama_pelanggan' => $request->nama_pelanggan[$i],
                    'alamat_pelanggan' => $request->alamat_pelanggan[$i],
                ]);
            }

            DB::commit();
            return redirect()->route('qa.5.1.index')->with('sukses', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function print(Recall $id)
    {
        $data  = [
            'title' => 'INFORMASI RECALL PRODUK',
            'dok' => 'Dok.No.: FRM.QA.05.01, Rev.00',
            'datas' => $id
        ];
        return view('qa.recall.informasi_recall_produk.print', $data);
    }
}

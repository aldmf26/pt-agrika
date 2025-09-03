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

    public function edit($id)
    {
        $sbw = DB::select("SELECT a.id,b.nama,a.no_invoice as no_lot FROM `sbw_kotor` as a
            join grade_sbw_kotor as b on a.grade_id = b.id");

        // Fetch the recall with its relationships
        $recall = Recall::with(['teamMembers', 'products'])->findOrFail($id);

        $data = [
            'title' => 'Edit Informasi Recall Produk',
            'namas' => DataPegawai::karyawan()->get(),
            'sbw' => $sbw,
            'recall' => $recall,
        ];

        return view('qa.recall.informasi_recall_produk.edit', $data);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            // Find the recall record
            $recall = Recall::findOrFail($id);

            // Update main recall data
            $recall->update([
                'skenario_recall' => $request->skenario,
            ]);

            // Delete existing team members and products
            RecallTeamMember::where('recall_id', $recall->id)->delete();
            RecallProduct::where('recall_id', $recall->id)->delete();

            // Insert new team members
            if ($request->nama && is_array($request->nama)) {
                for ($i = 0; $i < count($request->nama); $i++) {
                    if (!empty($request->nama[$i])) {
                        RecallTeamMember::create([
                            'recall_id' => $recall->id,
                            'nama' => $request->nama[$i],
                            'tugas' => $request->tugas[$i] ?? '',
                        ]);
                    }
                }
            }

            // Insert new products
            if ($request->nama_produk && is_array($request->nama_produk)) {
                for ($i = 0; $i < count($request->nama_produk); $i++) {
                    if (!empty($request->nama_produk[$i])) {
                        RecallProduct::create([
                            'recall_id' => $recall->id,
                            'nama' => $request->nama_produk[$i],
                            'no_lot' => $request->no_lot[$i] ?? '',
                            'jumlah_recall' => $request->jumlah_recall[$i] ?? 0,
                            'jumlah_distribusi' => $request->jumlah_distribusi[$i] ?? 0,
                            'nama_pelanggan' => $request->nama_pelanggan[$i] ?? '',
                            'alamat_pelanggan' => $request->alamat_pelanggan[$i] ?? '',
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('qa.5.1.index')->with('sukses', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function hasil(Recall $id)
    {
        $data = [
            'title' => 'Input Hasil Analisa Proses Recall',
            'datas' => $id,
        ];

        return view('qa.recall.informasi_recall_produk.hasil', $data);
    }

    public function store_hasil(Request $request, Recall $id)
    {
        DB::beginTransaction();
        try {

            // Update setiap produk recall dengan data hasil analisa
            foreach ($id->products as $index => $product) {
                $product->update([
                    'jumlah_ditarik' => $request->jumlah_berhasil_ditarik[$index] ?? 0,
                    'tgl_kembali' => $request->produk_kembali_tanggal[$index] ?? null,
                    'ket_hasil' => $request->keterangan[$index] ?? null,
                ]);
            }

            DB::commit();
            return redirect()->route('qa.5.1.index')->with('sukses', 'Hasil analisa berhasil disimpan.');
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

    public function hasil_print(Recall $id)
    {
        $data  = [
            'title' => 'HASIL ANALISA PROSES RECALL',
            'dok' => 'Dok.No.: FRM.QA.05.02, Rev.00',
            'datas' => $id
        ];
        return view('qa.recall.informasi_recall_produk.print_hasil', $data);
    }
}

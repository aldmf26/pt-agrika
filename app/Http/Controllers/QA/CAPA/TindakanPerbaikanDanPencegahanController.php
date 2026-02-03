<?php

namespace App\Http\Controllers\QA\CAPA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TindakanPerbaikanDanPencegahanController extends Controller
{
    public function index(Request $r)
    {

        // Contoh pakai DB, atau scan folder seperti sebelumnya
        $files = DB::table('excel_files')->where('kategori', $r->kategori)->orderBy('created_at', 'desc')->get(['id', 'nama_file', 'path', 'created_at', 'admin']);
        if ($r->kategori == 'capa') {
            $title = 'Tindakan Perbaikan dan Pencegahan';
        } else {
            $title = ucwords($r->kategori);
        }
        $data = [
            'title' => $title,
            'files' => $files,
            'kategori' => $r->kategori
        ];

        return view('qa.capa.tindakan_perbaikan_dan_pencegahan.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|array',
            'excel_file.*' => 'file|mimes:xlsx,xls,doc,docx,pdf,jpg,jpeg,png,webp|max:10240'
        ]);

        $files = $request->file('excel_file');
        $successCount = 0;

        foreach ($files as $file) {
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('public/excel', $filename);

            // Simpan ke DB
            DB::table('excel_files')->insert([
                'menu' => 'tindakan_perbaikan_dan_pencegahan',
                'nama_file' => $filename,
                'path' => $path,
                'admin' => auth()->user()->name,
                'kategori' => $request->kategori,
                'created_at' => now()
            ]);

            $successCount++;
        }

        return response()->json(['success' => true, 'message' => "$successCount file(s) berhasil diupload"]);
    }

    public function download($id)
    {
        $file = DB::table('excel_files')->where('id', $id)->first();
        if ($file) {
            return Storage::download('public/excel/' . $file->nama_file);
        }
        abort(404);
    }

    public function destroy($id)
    {
        $file = DB::table('excel_files')->where('id', $id)->first();
        if ($file) {
            Storage::delete('public/excel/' . $file->nama_file);
            DB::table('excel_files')->where('id', $id)->delete();
            return redirect()->back()->with('sukses', 'File sukses dihapus.');
        }
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return response()->json(['success' => false, 'message' => 'Tidak ada file yang dipilih']);
        }

        $files = DB::table('excel_files')->whereIn('id', $ids)->get();
        $deletedCount = 0;

        foreach ($files as $file) {
            Storage::delete('public/excel/' . $file->nama_file);
            DB::table('excel_files')->where('id', $file->id)->delete();
            $deletedCount++;
        }

        return response()->json([
            'success' => true,
            'message' => "$deletedCount file(s) berhasil dihapus"
        ]);
    }

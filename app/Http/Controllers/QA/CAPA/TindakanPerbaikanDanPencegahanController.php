<?php

namespace App\Http\Controllers\QA\CAPA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TindakanPerbaikanDanPencegahanController extends Controller
{
    public function index()
    {
        // Contoh pakai DB, atau scan folder seperti sebelumnya
        $files = DB::table('excel_files')->orderBy('created_at', 'desc')->get(['id', 'nama_file', 'path', 'created_at', 'admin']);
        $data = [
            'title' => 'Tindakan Perbaikan dan Pencegahan',
            'files' => $files
        ];

        return view('qa.capa.tindakan_perbaikan_dan_pencegahan.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls|max:10240' // 10MB
        ]);

        $file = $request->file('excel_file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('public/excel', $filename);

        // Simpan ke DB (opsional)
        DB::table('excel_files')->insert([
            'menu' => 'tindakan_perbaikan_dan_pencegahan',
            'nama_file' => $filename,
            'path' => $path,
            'admin' => auth()->user()->name,
            'created_at' => now()
        ]);

        return response()->json(['success' => true]);
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
}

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
        try {
            $request->validate([
                'excel_file' => 'required|array|max:20',
                'excel_file.*' => 'file|mimes:xlsx,xls,doc,docx,pdf,jpg,jpeg,png,webp|max:10240'
            ]);

            $files = $request->file('excel_file');
            $successCount = 0;
            $failedFiles = [];
            $duplicateFiles = [];

            foreach ($files as $index => $file) {
                try {
                    if (!$file || !$file->isValid()) {
                        $failedFiles[] = $file->getClientOriginalName() . " (File tidak valid)";
                        continue;
                    }

                    $filename = $file->getClientOriginalName();
                    
                    // Check if file already exists in database with same category
                    $existingFile = DB::table('excel_files')
                        ->where('nama_file', $filename)
                        ->where('kategori', $request->kategori)
                        ->first();

                    if ($existingFile) {
                        $duplicateFiles[] = $filename;
                        continue;
                    }

                    $path = $file->storeAs('public/excel', $filename);

                    DB::table('excel_files')->insert([
                        'menu' => 'tindakan_perbaikan_dan_pencegahan',
                        'nama_file' => $filename,
                        'path' => $path,
                        'admin' => auth()->user()->name,
                        'kategori' => $request->kategori,
                        'created_at' => now()
                    ]);

                    $successCount++;
                } catch (\Exception $e) {
                    $failedFiles[] = ($file ? $file->getClientOriginalName() : "File") . " (" . $e->getMessage() . ")";
                }
            }

            // All files failed
            if ($successCount === 0) {
                $errorMsg = [];
                if (!empty($duplicateFiles)) {
                    $errorMsg[] = count($duplicateFiles) . " file duplikat: " . implode(', ', array_slice($duplicateFiles, 0, 2));
                }
                if (!empty($failedFiles)) {
                    $errorMsg[] = count($failedFiles) . " file gagal";
                }
                
                return response()->json([
                    'success' => false,
                    'message' => implode(', ', $errorMsg) ?: 'Semua file gagal diupload'
                ], 400);
            }

            // Some files failed/duplicate
            if (!empty($failedFiles) || !empty($duplicateFiles)) {
                $warnings = [];
                if (!empty($duplicateFiles)) {
                    $warnings[] = count($duplicateFiles) . " file duplikat ditolak";
                }
                if (!empty($failedFiles)) {
                    $warnings[] = count($failedFiles) . " file gagal";
                }
                
                $message = "$successCount file berhasil diupload";
                if (!empty($warnings)) {
                    $message .= ", tetapi " . implode(", ", $warnings);
                }
                
                return response()->json([
                    'success' => true,
                    'partial' => true,
                    'successCount' => $successCount,
                    'failedCount' => count($failedFiles),
                    'duplicateCount' => count($duplicateFiles),
                    'message' => $message
                ]);
            }

            return response()->json([
                'success' => true,
                'partial' => false,
                'successCount' => $successCount,
                'failedCount' => 0,
                'duplicateCount' => 0,
                'message' => "$successCount file berhasil diupload"
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->errors();
            if (isset($errors['excel_file']) && in_array('The excel file field must not be greater than 20.', $errors['excel_file'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Maksimal 20 file per upload. Silakan kurangi jumlah file.'
                ], 422);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', array_values($errors)[0] ?? ['Unknown error'])
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server. Silakan coba lagi.'
            ], 500);
        }
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
        try {
            $ids = $request->input('ids', []);

            if (empty($ids)) {
                return redirect()->back()->with('error', 'Tidak ada file yang dipilih');
            }

            // Ensure ids is array
            if (!is_array($ids)) {
                $ids = [$ids];
            }

            $files = DB::table('excel_files')->whereIn('id', $ids)->get();

            if ($files->isEmpty()) {
                return redirect()->back()->with('error', 'File tidak ditemukan');
            }

            $deletedCount = 0;
            $failedCount = 0;

            foreach ($files as $file) {
                try {
                    Storage::delete('public/excel/' . $file->nama_file);
                    DB::table('excel_files')->where('id', $file->id)->delete();
                    $deletedCount++;
                } catch (\Exception $e) {
                    $failedCount++;
                    \Log::error('Delete file error: ' . $e->getMessage());
                }
            }

            $message = "$deletedCount file berhasil dihapus";
            if ($failedCount > 0) {
                $message .= ", $failedCount file gagal dihapus";
            }

            return redirect()->back()->with('sukses', $message);
        } catch (\Exception $e) {
            \Log::error('Bulk delete error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus file');
        }
    }
}

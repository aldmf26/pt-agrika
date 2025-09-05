<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Menu',
            'menus' => DB::select("SELECT a.id, a.title, a.link,a.contoh FROM menus as a where a.link is NOT null and a.parent_id != 115 order by a.title asc;")

        ];
        return view('menu.index', $data);
    }

    public function upload(Request $r)
    {
        // Validasi file
        $r->validate([
            'contoh' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        // Proses upload file jika ada
        $filename = null;
        if ($r->hasFile('contoh')) {
            $file = $r->file('contoh');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('contoh'), $filename);
        }

        // Kalau ada ID → UPDATE data
        if ($r->id) {
            // Cek apakah ada file lama
            $oldFile = DB::table('menus')->where('id', $r->id)->value('contoh');
            if ($filename && $oldFile && file_exists(public_path('contoh/' . $oldFile))) {
                unlink(public_path('contoh/' . $oldFile));
            }

            // Update data
            DB::table('contoh_image')->insert([
                'id_menu' => $r->id,
                'judul' => $r->judul,
                'contoh' => $filename ?? $oldFile,
            ]);

            return back()->with('success', 'Data berhasil diupdate!');
        }

        // Kalau tidak ada ID → INSERT data baru
        // DB::table('menus')->insert([
        //     'contoh' => $filename,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        return back()->with('success', 'Data berhasil disimpan!');
    }
}

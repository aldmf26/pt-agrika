<?php

namespace App\Http\Controllers;

use App\Models\DaftarIndukDokumenInternal;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $menus = Menu::whereNull('parent_id')
            ->whereNot('id', '115')
            ->orderBy('order')
            ->get();

        $pic = User::orderBy('name')
            ->get('name');

        $dokumen = DaftarIndukDokumenInternal::get();
        return view('dashboard.index', [
            'title' => 'Dashboard',
            'menus' => $menus,
            'pic' => $pic,
            'dokumen' => $dokumen,
            'route' => 'dashboard.detail'
        ]);
    }

    public function store(Request $r)
    {
        $tags = json_decode($r->tags);
        $tagsString = implode(', ', $tags);
        DaftarIndukDokumenInternal::create([
            'no_dokumen' => $r->no_dokumen,
            'divisi' => $r->divisi,
            'pic' => $r->pic,
            'judul' => $r->judul,
            'deskripsi' => $r->jenis,
            'tags' => $tagsString
        ]);
        return redirect()->route('dashboard.index')->with('sukses', 'Dokumen berhasil disimpan.');
    }

    public function showSubMenus($title, $route = 'dashboard.sub', $isSubLevel = false)
    {
        $menu = Menu::where('title', $title)->firstOrFail();
        $childMenus = Menu::where('parent_id', $menu->id)
            ->orderBy('id')
            ->get();

        return view('dashboard.index', [
            'title' => ucwords($title),
            'menus' => $childMenus,
            'route' => $route,
            'parentId' => $menu->id,
            'isSubLevel' => $isSubLevel
        ]);
    }

    public function detail($title)
    {
        return $this->showSubMenus($title);
    }

    public function sub($title)
    {
        return $this->showSubMenus($title, 'dashboard.sub', true);
    }
}

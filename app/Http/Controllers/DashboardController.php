<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $menus = Menu::whereNull('parent_id')
            ->whereNot('id', '115')
            ->orderBy('order')
            ->get();

        return view('dashboard.index', [
            'title' => 'Dashboard',
            'menus' => $menus,
            'route' => 'dashboard.detail'
        ]);
    }

    public function showSubMenus($title, $route = 'dashboard.sub',$isSubLevel = false)
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
        return $this->showSubMenus($title,'dashboard.sub', true);
    }
}

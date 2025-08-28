<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Menu',
            'menu' => DB::table('menus')->get()

        ];
        return view('menu.index', $data);
    }
}

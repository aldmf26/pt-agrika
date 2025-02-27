<?php

namespace App\Http\Controllers\PPC\Gudang_RM;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class RM10KodeProdukJadiController extends Controller
{
    public static function getDatas()
    {
        return [
            (object) [
                'nama' => 'Grade S6',
                'kategori' => 'Produk Jadi',
                'kode' => '0001',
                'satuan' => 'Pcs & Gram',
                'ket' => 'Mangkok',
            ],
            (object) [
                'nama' => 'Grade A6',
                'kategori' => 'Produk Jadi',
                'kode' => '0002',
                'satuan' => 'Pcs & Gram',
                'ket' => 'Mangkok',
            ],
            (object) [
                'nama' => 'Grade Y6',
                'kategori' => 'Produk Jadi',
                'kode' => '0003',
                'satuan' => 'Pcs & Gram',
                'ket' => 'Mangkok',
            ],
            (object) [
                'nama' => 'Grade S5',
                'kategori' => 'Produk Jadi',
                'kode' => '0004',
                'satuan' => 'Pcs & Gram',
                'ket' => 'Mangkok',
            ],
            (object) [
                'nama' => 'Grade A5',
                'kategori' => 'Produk Jadi',
                'kode' => '0005',
                'satuan' => 'Pcs & Gram',
                'ket' => 'Mangkok',
            ],
            (object) [
                'nama' => 'Grade Y5',
                'kategori' => 'Produk Jadi',
                'kode' => '0006',
                'satuan' => 'Pcs & Gram',
                'ket' => 'Mangkok',
            ],
            (object) [
                'nama' => 'Grade S4',
                'kategori' => 'Produk Jadi',
                'kode' => '0004',
                'satuan' => 'Pcs & Gram',
                'ket' => 'Mangkok',
            ],
            (object) [
                'nama' => 'Grade A4',
                'kategori' => 'Produk Jadi',
                'kode' => '0005',
                'satuan' => 'Pcs & Gram',
                'ket' => 'Mangkok',
            ],
            (object) [
                'nama' => 'Grade Y4',
                'kategori' => 'Produk Jadi',
                'kode' => '0006',
                'satuan' => 'Pcs & Gram',
                'ket' => 'Mangkok',
            ],
        ];
    }
    public function index()
    {
        $barangs = Barang::with('kode_bahan_baku')->latest()->get();
        $data = [
            'title' => 'Kode Produk Jadi',
            'barangs' => $barangs,
            'datas' => $this->getDatas(),
        ];
        return view('ppc.gudang_rm.kode_produk_jadi.index', $data);
    }

    public function print()
    {
        $data = [
            'title' => 'KODE PRODUK JADI',
            'dok' => 'Dok.No.: FRM.WH.04.03, Rev.00',
            'datas' => $this->getDatas(),

        ];
        return view('ppc.gudang_rm.kode_produk_jadi.print', $data);
    }
}

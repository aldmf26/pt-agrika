<?php

namespace App\Services;

use App\Models\Barang;
use App\Models\Lot;
use App\Models\Transaksi;

class TransaksiStokService
{
    public static function create($request, $admin)
    {
        // Buat Lot baru
        $lot = Lot::create([
            'barang_id' => $request->id_barang,
            'kode_lot' => $request->kode_lot,
            'tgl_kedatangan' => $request->tgl_penerimaan,
            'tgl_expired' => $request->tgl_expired,
            'qty' => $request->jumlah_barang,
            'tgl' => date('Y-m-d'),
            'admin' => $admin
        ]);

        // Update stok barang
        $barang = Barang::find($request->id_barang);
        $stok = $barang->stok;
        
        // Buat transaksi masuk
        Transaksi::create([
            'barang_id' => $request->id_barang,
            'lot_id' => $lot->id,
            'jenis' => 'masuk',
            'qty' => $request->jumlah_barang,
            'stok_sebelum' => $stok,
            'stok_sesudah' => $stok + $request->jumlah_barang,
            'tgl' => date('Y-m-d'),
            'admin' => $admin
        ]);

        // Update stok di tabel barang
        $barang->update(['stok' => $stok + $request->jumlah_barang]);

        return $barang; // Return jika perlu
    }
}
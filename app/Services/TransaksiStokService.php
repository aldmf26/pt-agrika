<?php

namespace App\Services;

use App\Models\Barang;
use App\Models\Lot;
use App\Models\Transaksi;

class TransaksiStokService
{
    public static function create($request, $admin)
    {
        dd($request->id_barang);
        // Buat Lot baru
        for ($i = 0; $i < count($request->id_barang); $i++) {
            $lot = Lot::create([
                'barang_id' => $request->id_barang[$i],
                'kode_lot' => $request->kode_lot[$i],
                'tgl_kedatangan' => $request->tgl_penerimaan[$i],
                'tgl_expired' => $request->tgl_expired[$i],
                'qty' => $request->jumlah_barang[$i],
                'tgl' => date('Y-m-d'),
                'admin' => $admin
            ]);

            // Update stok barang
            $barang = Barang::find($request->id_barang[$i]);
            $stok = $barang->stok;

            // Buat transaksi masuk
            Transaksi::create([
                'barang_id' => $request->id_barang[$i],
                'lot_id' => $lot->id,
                'jenis' => 'masuk',
                'qty' => $request->jumlah_barang[$i],
                'stok_sebelum' => $stok,
                'stok_sesudah' => $stok + $request->jumlah_barang[$i],
                'tgl' => date('Y-m-d'),
                'admin' => $admin
            ]);

            // Update stok di tabel barang
            $barang->update(['stok' => $stok + $request->jumlah_barang[$i]]);
        }

        return $barang; // Return jika perlu
    }
}

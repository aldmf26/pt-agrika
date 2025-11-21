<?php

namespace App\Jobs;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SyncHasapData
{
    public function handle(): void
    {
        $response = Http::get("https://sarang.ptagafood.com/api/apihasap/download");

        if (!$response->successful()) {
            Log::error("HASAP API gagal", ['response' => $response->body()]);
            return;
        }

        $download = $response->json('data') ?? [];

        if (empty($download)) {
            Log::warning("HASAP API return kosong");
            return;
        }

        // 🔥 Hapus semua data lama (yang tidak FIX)
        DB::table('persiapan_serah_terima')->where('fix', 'T')->delete();

        // 🔥 Insert ulang data dari API
        foreach (array_chunk($download, 500) as $chunk) {

            $insert = array_map(function ($value) {
                return [
                    'tgl'            => $value['tgl'] ?? null,
                    'nama_petugas'   => $value['name'] ?? null,
                    'nama_pencabut'  => $value['nama'] ?? null,
                    'nm_partai'      => $value['nm_partai'] ?? null,
                    'no_box'         => $value['no_box'] ?? null,
                    'pcs'            => $value['pcs'] ?? 0,
                    'gr'             => $value['gr_awal'] ?? 0,
                ];
            }, $chunk);

            DB::table('persiapan_serah_terima')->insert($insert);
        }
    }
}

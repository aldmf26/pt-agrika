<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\DataPegawai;

class DataPegawaiService
{
    /**
     * Mengunduh data pegawai dari sumber tertentu (web1 atau web2)
     *
     * @param string $sumber ('web1' atau 'web2')
     * @return void
     */
    public function download(): void
    {
        // Tentukan URL berdasarkan link data

        // Lakukan request GET ke URL
        $url = "https://sarang.ptagafood.com/api/data-pegawai";

        $response = Http::get($url);

        if ($response->successful()) {
            $dataPegawai = $response->json();
            $sumberData = $dataPegawai['sumber_data'];
            DataPegawai::where('sumber_data', $sumberData)->delete();
            foreach ($dataPegawai['pegawai'] as $pegawai) {
                // Simpan atau perbarui data pegawai di database lokal
                $keterangan = $sumberData == 'sarang' ? ($pegawai['kelas_cbt'] ?? null) : ($pegawai['keterangan'] ?? null);
                if (($pegawai['id_pengawas'] != null && $pegawai['id_anak'] != 0) || ($pegawai['id_anak'] == 0 && !empty($pegawai['posisi']))) {
                    DataPegawai::updateOrCreate(
                        [
                            'karyawan_id_dari_api' => $pegawai['id_pegawai'] ?? null,
                        ],
                        [
                            'nik' => $pegawai['nik'] ?? null,
                            'nama' => $pegawai['nama'] ?? null,
                            'email' => $pegawai['email'] ?? null,
                            'no_telepon' => $pegawai['no_telepon'] ?? null,
                            'tgl_lahir' => $pegawai['tgl_lahir'] ?? null,
                            'tgl_masuk' => $pegawai['tgl_masuk'] ?? null,
                            'divisi_id' => $pegawai['divisi_id'] ?? null,
                            'posisi' => $pegawai['posisi'] ?? null,
                            'jenis_kelamin' => $pegawai['jenis_kelamin'] ?? '',
                            'status' => $pegawai['status'] ?? 'kontrak',
                            'gaji' => $pegawai['gaji'] ?? 0,
                            'pendidikan' => $pegawai['pendidikan'] ?? 'SMA',
                            'sumber_data' => $sumberData,
                            'karyawan_id_dari_api' => $pegawai['id_pegawai'],
                            'keterangan' => $keterangan,
                            'admin' => 'download',
                            'deleted_at' => $pegawai['deleted_at']
                        ]
                    );
                }
            }
        } else {
            throw new \Exception('Gagal mengunduh data dari ' . $url);
        }
    }
}

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
    public function download(string $url): void
    {
        // Tentukan URL berdasarkan link data

        // Lakukan request GET ke URL
        $response = Http::get($url);
        if ($response->successful()) {
            $dataPegawai = $response->json();
            dd($dataPegawai['pegawai']);
            foreach ($dataPegawai as $pegawai) {
                // Simpan atau perbarui data pegawai di database lokal
                DataPegawai::updateOrCreate(
                    ['id_pegawai' => $pegawai['id_pegawai'], 'sumber_data' => $url], // Identifikasi data unik
                    [
                        'nik' => $pegawai['nik'] ?? '',
                        'nama' => $pegawai['nama'],
                        'email' => $pegawai['email'],
                        'nomor_telepon' => $pegawai['nomor_telepon'],
                        'tgl_lahir' => $pegawai['tgl_lahir'],
                        'tgl_masuk' => $pegawai['tgl_masuk'],
                        'divisi_id' => $pegawai['divisi_id'],
                        'posisi' => $pegawai['posisi'],
                        'status' => $pegawai['status'],
                        'gaji' => $pegawai['gaji'],
                        'pendidikan' => $pegawai['pendidikan'],
                        'sumber_data' => $pegawai['sumber_data'],
                        'karyawan_id_dari_api' => $pegawai['id_pegawai'],
                        'keterangan' => $pegawai['sumber_data'] == 'sarang' ? $pegawai['kelas_cbt'] : $pegawai['keterangan'],
                    ]
                );
            }
        } else {
            throw new \Exception('Gagal mengunduh data dari ' . $url);
        }
    }
}

<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\DataPegawai;
use App\Models\HasilWawancara;
use App\Models\PenilaianKaryawan;

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

            HasilWawancara::where('admin', 'download')->delete();
            foreach ($dataPegawai['hasil_wawancara'] as $wawancara) {
                HasilWawancara::updateOrCreate(
                    [
                        'id_anak' => $wawancara['id'] ?? null,
                    ],
                    [
                        'nama' => $wawancara['nama_lengkap'] ?? null,
                        'nik' => $wawancara['nik'] ?? null,
                        'tgl_lahir' => $wawancara['tgl_lahir'] ?? null,
                        'jenis_kelamin' => $wawancara['jenis_kelamin'] ?? null,
                        'id_divisi' => $wawancara['id_divisi'] ?? null,
                        'kesimpulan' => $wawancara['kesimpulan'] ?? null,
                        'keputusan' => $wawancara['keputusan'] ?? 'dilanjutkan',
                        'tgl_masuk' => $wawancara['tgl_masuk'] ?? null,
                        'admin' => 'download',
                    ]
                );
            }

            PenilaianKaryawan::where('admin', 'download')->delete();
            foreach ($dataPegawai['penilaian_karyawan'] as $penilaian) {
                PenilaianKaryawan::updateOrCreate(
                    [
                        'id_anak' => $penilaian['id_anak'] ?? null,
                    ],
                    [
                        'periode' => $penilaian['periode'] ?? null,
                        'pendidikan_standar' => $penilaian['pendidikan_standar'] ?? null,
                        'pendidikan_hasil' => $penilaian['pendidikan_hasil'] ?? null,
                        'pengalaman_standar' => $penilaian['pengalaman_standar'] ?? null,
                        'pengalaman_hasil' => $penilaian['pengalaman_hasil'] ?? null,
                        'pelatihan_standar' => $penilaian['pelatihan_standar'] ?? null,
                        'pelatihan_hasil' => $penilaian['pelatihan_hasil'] ?? null,
                        'keterampilan_standar' => $penilaian['keterampilan_standar'] ?? null,
                        'keterampilan_hasil' => $penilaian['keterampilan_hasil'] ?? null,
                        'kompetensi_inti_standar' => $penilaian['kompetensi_inti_standar'] ?? null,
                        'kompetensi_inti_hasil' => $penilaian['kompetensi_inti_hasil'] ?? null,
                        'admin' => 'download',
                    ]
                );
            }
        } else {
            throw new \Exception('Gagal mengunduh data dari ' . $url);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Menu utama
        $menuHrga = Menu::create(['title' => 'Hrga', 'icon' => 'bi bi-file-earmark-medical-fill']);

        // Submenu Hrga 1
        $hrga1 = Menu::create(['title' => 'Hrga 1 Penerimaan Karyawan Baru', 'parent_id' => $menuHrga->id]);
        Menu::insert([
            [
                'title' => 'Hrga 1.1 Permohonan Karyawan',
                'link' => 'hrga1.1.index',
                'parent_id' => $hrga1->id
            ],

            [
                'title' => 'Hrga 1.2 Hasil Wawancara',
                'link' => 'hrga1.2.index',
                'parent_id' => $hrga1->id
            ],

            [
                'title' => 'Hrga 1.3 Hasil Evaluasi Karyawan Baru',
                'link' => 'hrga1.3.index',
                'parent_id' => $hrga1->id
            ],

            [
                'title' => 'Hrga 1.4 Data Pegawai',
                'link' => 'hrga1.4.index',
                'parent_id' => $hrga1->id
            ],

        ]);

        // Submenu Hrga 2
        $hrga2 = Menu::create(['title' => 'Hrga 2 Penilaian Kompetensi', 'parent_id' => $menuHrga->id]);
        Menu::insert([
            [
                'title' => 'Hrga 2.1 Daftar Nama dan Posisi Karyawan',
                'link' => 'hrga1.1.index',
                'parent_id' => $hrga2->id
            ],

            [
                'title' => 'Hrga 2.2 Penilaian Kompetensi',
                'link' => 'hrga1.1.index',
                'parent_id' => $hrga2->id
            ],

            [
                'title' => 'Hrga 2.3 Struktur Organisasi',
                'link' => 'hrga1.1.index',
                'parent_id' => $hrga2->id
            ],

            [
                'title' => 'Hrga 2.4 Jobdesk',
                'link' => 'hrga1.1.index',
                'parent_id' => $hrga2->id
            ],

            [
                'title' => 'Hrga 2.5 Jadwal GAP Analysis',
                'link' => 'hrga1.1.index',
                'parent_id' => $hrga2->id
            ],
        ]);

        // Submenu Hrga 3
        $hrga3 = Menu::create([
            'title' => 'Hrga 3 Pelatihan',
            'parent_id' => $menuHrga->id
        ]);
        $id = $hrga3->id;
        Menu::insert([
            [
                'title' => 'Hrga 3.1 informasi tawaran pelatihan',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ],

            [
                'title' => 'Hrga 3.2 perogram pelatihan tahunan',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ],

            [
                'title' => 'Hrga 3.3 Usulan dan Identifikasi Kebutuhan Pelatihan',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ],

            [
                'title' => 'Hrga 3.4 Jadwal dan Informasi Pelatihan',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ],

            [
                'title' => 'Hrga 3.5 Daftar Hadir Pelatihan',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ],
            [
                'title' => 'Hrga 3.6 Evaluasi Pelatihan',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ],
        ]);

        // Submenu Hrga 3
        $hrga4 = Menu::create([
            'title' => 'Hrga 4 Medical Screening',
            'parent_id' => $menuHrga->id
        ]);
        $id = $hrga4->id;
        Menu::insert([
            [
                'title' => 'Hrga 4.1 Jadwal Medical Check Up',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ]
        ]);

        // Submenu Hrga 3
        $hrga5 = Menu::create([
            'title' => 'Hrga 5 Pemeliharaan Perbaikan Sarana Prasarana',
            'parent_id' => $menuHrga->id
        ]);
        $id = $hrga5->id;
        Menu::insert([
            [
                'title' => 'Hrga 5.1 Program Perawatan Sarana dan Prasarana Umum',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ],

            [
                'title' => 'Hrga 5.2 Riwayat Pemeliharaan Sarana dan Prasarana Umum',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ],

            [
                'title' => 'Hrga 5.3 Permintaan Perbaikan Sarana dan Prasarana Umum',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ]
        ]);

        // Submenu Hrga 3
        $hrga6 = Menu::create([
            'title' => 'Hrga 6 Sanitasi',
            'parent_id' => $menuHrga->id
        ]);
        $id = $hrga6->id;
        Menu::insert([
            [
                'title' => 'Hrga 6.1 Perencanaan Kebersihan',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ],

            [
                'title' => 'Hrga 6.2 Ceklis Sanitasi',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ],

            [
                'title' => 'Hrga 6.3 Identitas Area',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ],
            [
                'title' => 'Hrga 6.4 Ceklis Foot Bath',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ]
        ]);

        $hrga7 = Menu::create([
            'title' => 'Hrga 7 Pengelolaan limbah',
            'parent_id' => $menuHrga->id
        ]);
        $id = $hrga7->id;
        Menu::insert([
            [
                'title' => 'Hrga 7.1 Schedule pembuangan sampah',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ],

            [
                'title' => 'Hrga 7.2 Schedule pembuangan TPS',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ],

            [
                'title' => 'Hrga 7.3 Identifikasi Limbah',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ],
        ]);

        $hrga8 = Menu::create([
            'title' => 'Hrga 8 Perawatan dan Perbaikan Mesin',
            'parent_id' => $menuHrga->id
        ]);
        $id = $hrga8->id;
        Menu::insert([
            [
                'title' => 'Hrga 8.1 PROGRAM PERAWATAN MESIN PROSES PRODUKSI',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ],

            [
                'title' => 'Hrga 8.2 CEKLIST PERAWATAN MESIN PROSES PRODUKSI',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ],

            [
                'title' => 'Hrga 8.3 PERMINTAAN PERBAIKAN MESIN PROSES PRODUKSI',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ],
            [
                'title' => 'Hrga 8.4 CEKLIST SUHU AC',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ],
            [
                'title' => 'Hrga 8.5 CEKLIST PEMERIKSAN DAN KONDISI MESIN HARIAN',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ],
            [
                'title' => 'Hrga 8.6 CEKLIST SUHU COLD STORAGE',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ],
            [
                'title' => 'Hrga 8.7 CEKLIST PENGECEKAN AIR',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ],
        ]);

        $hrga9 = Menu::create([
            'title' => 'Hrga 9 Kalibarasi',
            'parent_id' => $menuHrga->id
        ]);
        $id = $hrga9->id;
        Menu::insert([
            [
                'title' => 'Hrga 9.1 PROGRAM KALIBRASI SARANA PEMANTAUAN DAN PENGUKURAN',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ],

            [
                'title' => 'Hrga 9.2 JADWAL KALIBRASI VERIFIKASI',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ],
        ]);

        $hrga10 = Menu::create([
            'title' => 'Hrga 10 Penerimaan Tamu',
            'parent_id' => $menuHrga->id
        ]);
        $id = $hrga10->id;
        Menu::insert([
            [
                'title' => 'Hrga 10.1 VISITOR HEALTH MONITORING FORM',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ],

            [
                'title' => 'Hrga 10.2 REGISTRASI TAMU',
                'link' => 'hrga1.1.index',
                'parent_id' => $id
            ],
        ]);
    }
}

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
            ['title' => 'Hrga 1.1 Permohonan Karyawan', 'link' => 'form-element-input.html', 'parent_id' => $hrga1->id],
            ['title' => 'Hrga 1.2 Hasil Wawancara', 'link' => 'form-element-input.html', 'parent_id' => $hrga1->id],
            ['title' => 'Hrga 1.3 Hasil Evaluasi Karyawan Baru', 'link' => 'form-element-input.html', 'parent_id' => $hrga1->id],
            ['title' => 'Hrga 1.4 Data Pegawai', 'link' => 'form-element-input.html', 'parent_id' => $hrga1->id],
        ]);

        // Submenu Hrga 2
        $hrga2 = Menu::create(['title' => 'Hrga 2 Penilaian Kompetensi', 'parent_id' => $menuHrga->id]);
        Menu::insert([
            ['title' => 'Hrga 2.1 Daftar Nama dan Posisi Karyawan', 'link' => 'form-element-input.html', 'parent_id' => $hrga2->id],
            ['title' => 'Hrga 2.2 Penilaian Kompetensi', 'link' => 'form-element-input.html', 'parent_id' => $hrga2->id],
            ['title' => 'Hrga 2.3 Struktur Organisasi', 'link' => 'form-element-input.html', 'parent_id' => $hrga2->id],
            ['title' => 'Hrga 2.4 Jobdesk', 'link' => 'form-element-input.html', 'parent_id' => $hrga2->id],
            ['title' => 'Hrga 2.5 Jadwal GAP Analysis', 'link' => 'form-element-input.html', 'parent_id' => $hrga2->id],
        ]);
    }
}

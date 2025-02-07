<?php

namespace Database\Seeders;

use App\Models\ItemMesin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemMesein extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ItemMesin::insert([
            ['nama_mesin' => 'Retort', 'merek' => 'indah jaya teknik', 'lokasi_id' => 27, 'no_identifikasi' => ' '],
            ['nama_mesin' => 'Mesin wrapping', 'merek' => 'getra', 'lokasi_id' => 35, 'no_identifikasi' => ' '],
        ]);
    }
}

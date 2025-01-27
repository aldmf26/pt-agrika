<?php

namespace Database\Seeders;

use App\Models\ItemKalibrasiModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemKalibrasiseed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ItemKalibrasiModel::insert([
            ['name' => 'Digital timer', 'merk' => '', 'nomor_seri' => 'Count Down / DC 101', 'lokasi_id' => 45],
            ['name' => 'Digital timer', 'merk' => '', 'nomor_seri' => 'Count Down / DC 101', 'lokasi_id' => 45],
            ['name' => 'Timbangan analitik', 'merk' => 'Kern', 'nomor_seri' => 'ABJ 220-4M/WB1250606', 'lokasi_id' => 38],
            ['name' => 'Timbangan Digital', 'merk' => 'Matrix', 'nomor_seri' => 'A12E', 'lokasi_id' => 0],
            ['name' => 'Timbangan Digital', 'merk' => 'Matrix', 'nomor_seri' => 'A12E', 'lokasi_id' => 0],
            ['name' => 'Timbangan Digital', 'merk' => 'Matrix', 'nomor_seri' => 'A12E / 1501187', 'lokasi_id' => 0],
            ['name' => 'Termohygrometer', 'merk' => 'Thermopro', 'nomor_seri' => 'TP-53', 'lokasi_id' => 0],
            ['name' => 'Termohygrometer', 'merk' => 'Thermopro', 'nomor_seri' => 'TP-53', 'lokasi_id' => 0],
            ['name' => 'Termohygrometer', 'merk' => 'Thermopro', 'nomor_seri' => 'TP-53', 'lokasi_id' => 0],
            ['name' => 'Termohygrometer', 'merk' => 'Thermopro', 'nomor_seri' => 'TP-53', 'lokasi_id' => 0],
            ['name' => 'Termohygrometer', 'merk' => 'Thermopro', 'nomor_seri' => 'TP-53', 'lokasi_id' => 0],
            ['name' => 'Termohygrometer', 'merk' => 'Thermopro', 'nomor_seri' => 'TP-53', 'lokasi_id' => 0],
            ['name' => 'Termohygrometer', 'merk' => 'Thermopro', 'nomor_seri' => 'TP-53', 'lokasi_id' => 0],
            ['name' => 'Termohygrometer', 'merk' => 'Thermopro', 'nomor_seri' => 'TP-53', 'lokasi_id' => 0],
            ['name' => 'Stopwatch', 'merk' => 'Taffsport', 'nomor_seri' => 'ZSD-808/171888390', 'lokasi_id' => 0],
            ['name' => 'Spektrofotometer', 'merk' => 'Thermo Scientific', 'nomor_seri' => 'Genesys 30/9A1Z287725', 'lokasi_id' => 0],
            ['name' => 'Stopwatch', 'merk' => 'Taffsport', 'nomor_seri' => 'ZSD-808/171888390', 'lokasi_id' => 0],
            ['name' => 'Stopwatch', 'merk' => 'Taffsport', 'nomor_seri' => 'ZSD-808/171888390', 'lokasi_id' => 0],
            ['name' => 'Mikropipet', 'merk' => 'Drag On Lab', 'nomor_seri' => 'YEA1AAD0069312', 'lokasi_id' => 0],
            ['name' => 'Timer', 'merk' => 'Latina', 'nomor_seri' => '-', 'lokasi_id' => 0],
            ['name' => 'Timer', 'merk' => 'Latina', 'nomor_seri' => '-', 'lokasi_id' => 0],
            ['name' => 'Timer', 'merk' => 'Latina', 'nomor_seri' => '-', 'lokasi_id' => 0],
            ['name' => 'Thermometer gun', 'merk' => 'coolpad', 'nomor_seri' => 'CP600', 'lokasi_id' => 0],
        ]);
    }
}

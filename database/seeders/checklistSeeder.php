<?php

namespace Database\Seeders;

use App\Models\ChecklistItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class checklistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sanitasiCollection = [
            [
                'id' => 1,
                'title' => 'A. Sanitasi Lokasi dan Lingkungan: Fisik',
                'parent_id' => null,
                'order' => 1,
            ],
            [
                'id' => 2,
                'title' => 'Lingkungan tidak bebas dari semak belukar/ rumput liar',
                'parent_id' => 1,
                'order' => 1,
            ],
            [
                'id' => 3,
                'title' => 'Lingkungan tidak bebas dari sampah dan barang-barang tidak berguna di area pabrik maupun luarnya',
                'parent_id' => 1,
                'order' => 2,
            ],
            [
                'id' => 4,
                'title' => 'Tidak ada tempat sampah disekitar lingkungan pabrik atau tempat sampah ada tetapi tidak dirawat dengan baik',
                'parent_id' => 1,
                'order' => 3,
            ],
            [
                'id' => 5,
                'title' => 'Bangunan yang digunakan untuk menyimpan perlengkapan tidak teratur, tidak terawat dan tidak mudah dibersihkan',
                'parent_id' => 1,
                'order' => 4,
            ],
            [
                'id' => 6,
                'title' => 'Ada tempat pemeliharaan hewan yang memungkinkan menjadi sumber kontaminasi',
                'parent_id' => 1,
                'order' => 5,
            ],
            [
                'id' => 7,
                'title' => 'Terdapat debu, asap, bau yang berlebihan dijalanan, tempat parkir atau sekeliling pabrik',
                'parent_id' => 1,
                'order' => 6,
            ],
            [
                'id' => 8,
                'title' => 'B. Sanitasi Lingkungan: Pembuangan Limbah',
                'parent_id' => null,
                'order' => 2,
            ],
            [
                'id' => 9,
                'title' => 'Sistem pembuangan limbah cair/ salluran disekitar lingkungan pabrik kurang baik',
                'parent_id' => 8,
                'order' => 1,
            ],
            [
                'id' => 10,
                'title' => 'Kapasitas saluran dilingkungan pabrik tidak mencukupi',
                'parent_id' => 8,
                'order' => 2,
            ],
            [
                'id' => 11,
                'title' => 'Pembuangan limbah: Cair, Padat, Sampah disekitar lingkungan pabrik',
                'parent_id' => null,
                'order' => 3,
            ],
            [
                'id' => 12,
                'title' => 'Limbah cair disekitar lingkungan tidak ditangani dengan baik',
                'parent_id' => 11,
                'order' => 1,
            ],
            [
                'id' => 13,
                'title' => 'Konstruksi tempat pembuangan limbah tidak selayaknya',
                'parent_id' => 11,
                'order' => 2,
            ],
            [
                'id' => 14,
                'title' => 'Tempat dan wadah sampah tidak ada penutupnya',
                'parent_id' => 11,
                'order' => 3,
            ],
            [
                'id' => 15,
                'title' => 'Tidak terdapat identifikasi sampah (organic dan anorganik)',
                'parent_id' => 11,
                'order' => 4,
            ],
            [
                'id' => 16,
                'title' => 'Ada akumulasi limbah di area produksi dan gudang',
                'parent_id' => 11,
                'order' => 5,
            ],
            [
                'id' => 17,
                'title' => 'Arah drainase mengalir kembali dari area yang terkontaminasi ke area bersih',
                'parent_id' => 11,
                'order' => 6,
            ],
        ];

        foreach ($sanitasiCollection as $item) {
            ChecklistItem::create($item);
        }
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Buat tabel master_kondisi
        Schema::create('master_kondisi', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor');
            $table->text('kondisi');
            $table->timestamps();
        });

        // Buat tabel checklist_kendaraan 
        Schema::create('checklist_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nomor_kendaraan', 20);
            $table->string('pengemudi', 100);
            $table->enum('jenis_kendaraan', ['Internal', 'Ekspedisi']);
            $table->string('ekspedisi', 100)->nullable();
            $table->time('jam_datang');
            $table->string('tujuan', 100);
            $table->string('customer', 100);
            $table->string('negara', 100);
            $table->unsignedBigInteger('nomor_kondisi');
            $table->char('check_wh', 1)->nullable();
            $table->char('check_qa', 1)->nullable();
            $table->enum('keputusan', ['Y', 'T'])->nullable();
            $table->string('pemeriksa', 50)->nullable();
            $table->text('komentar')->nullable();
            $table->timestamps();

            $table->foreign('nomor_kondisi')->references('id')->on('master_kondisi');
        });

        // Insert data master kondisi
        $kondisi = [
            ['nomor' => 1, 'kondisi' => 'BAGIAN LUAR KENDARAAN SECARA UMUM DALAM KEADAAN BERSIH'],
            ['nomor' => 2, 'kondisi' => 'BAK KENDARAAN HARUS DALAM KEADAAN BERSIH DARI KOTORAN'],
            ['nomor' => 3, 'kondisi' => 'LANTAI DAN DINDING BAK KENDARAAN HARUS RATA DAN HALUS'],
            ['nomor' => 4, 'kondisi' => 'TIDAK ADA PAKU ATAU BAUT DARI BAK KENDARAAN YANG KELUAR/LEPAS'],
            ['nomor' => 5, 'kondisi' => 'BAK-KENDARAAN TIDAK BERLUBANG ATAU BOCOR'],
            ['nomor' => 6, 'kondisi' => 'BAK-KENDARAAN TIDAK BERBAU ASING (BAU HARUS NORMAL)'],
            ['nomor' => 7, 'kondisi' => 'BAK-KENDARAAN HARUS DALAM KEADAAN KERING DAN TIDAK BERMINYAK'],
            ['nomor' => 8, 'kondisi' => 'TIDAK ADA SERANGGA (KECOA, KUTU DLL) DALAM BAK KENDARAAN'],
            ['nomor' => 9, 'kondisi' => 'KACA KEPALA KENDARAAN HARUS UTUH -TIDAK RUSAK/PECAH'],
            ['nomor' => 10, 'kondisi' => 'KHUSUS TRUK TERBUKA HARUS DILENGKAPI TERPAL'],
            ['nomor' => 11, 'kondisi' => 'DAN HARUS MEMBAWA KAYU/PAPAN/BESI SIKU SEBAGAI PENAHAN PRODUK']
        ];

        foreach ($kondisi as $item) {
            DB::table('master_kondisi')->insert([
                'nomor' => $item['nomor'],
                'kondisi' => $item['kondisi'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checklist_kendaraan');
       Schema::dropIfExists('master_kondisi');
    }
};

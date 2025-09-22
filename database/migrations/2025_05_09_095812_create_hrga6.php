<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create('hrga6_perencanaan_sanitasi', function (Blueprint $table) {
        //     $table->id('id_perencanaan');
        //     $table->integer('id_lokasi')->index();
        //     $table->string('nm_alat', 100);
        //     $table->string('identifikasi_alat', 100);
        //     $table->string('metode', 200);
        //     $table->string('penanggung_jawab', 100);
        //     $table->string('frekuensi', 100);
        //     $table->string('sarana_cleaning', 100);
        //     $table->string('sanitizer', 200);
        //     $table->timestamp('tgl')->useCurrent();
        //     $table->string('admin', 100);
        //     $table->timestamps();
        // });

        // Schema::create('hrga7_identifikasi_limbah', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('area', 100);
        //     $table->string('limbah', 100);
        //     $table->string('metode', 200);
        //     $table->string('ket', 200)->nullable();
        //     $table->date('tgl_input');
        //     $table->string('admin', 100);
        // });

        // Schema::create('hrga7_pembuangan_sampah', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('jenis_sampah', 100)->nullable();
        //     $table->date('tgl')->nullable();
        //     $table->string('jam_cek', 100)->nullable();
        //     $table->string('paraf_petugas', 100)->nullable();
        //     $table->string('ket', 250)->nullable();
        //     $table->string('admin', 100);
        // });

        // Schema::create('hrga7_pembuangan_tps', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('jenis_sampah', 100)->nullable();
        //     $table->date('tgl')->nullable();
        //     $table->time('jam_cek')->nullable();
        //     $table->string('paraf_petugas', 100)->nullable();
        //     $table->string('ket', 250)->nullable();
        //     $table->string('admin', 100);
        // });

        // Schema::create('hrga8_ceklist_pengecekan_air', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('jenis_mesin', 100);
        //     $table->date('tgl')->nullable();
        //     $table->string('kondisi', 100)->nullable();
        //     $table->string('kondisi_air', 100)->nullable();
        //     $table->string('pemeriksa', 100)->nullable();
        //     $table->string('paraf', 100)->nullable();
        //     $table->string('admin', 100);
        // });

        // Schema::create('hrga8_ceklist_suhu_cold_storage', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('standar_suhu', 100);
        //     $table->date('tgl')->nullable();
        //     $table->string('ruangan', 100)->nullable();
        //     $table->string('suhu', 100)->nullable();
        //     $table->string('pemeriksa', 100)->nullable();
        //     $table->string('ket', 100)->nullable();
        //     $table->string('admin', 100);
        // });

        // Schema::create('hrga8_ceklist_suhu_ruangan', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('standar_suhu', 100);
        //     $table->date('tgl')->nullable();
        //     $table->string('ruangan', 100)->nullable();
        //     $table->string('suhu', 100)->nullable();
        //     $table->string('pemeriksa', 100)->nullable();
        //     $table->string('ket', 100)->nullable();
        //     $table->string('admin', 100);
        // });

        // Schema::create('hrga9_1kalibrasi', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->integer('item_kalibrasi_id');
        //     $table->string('frekuensi', 255);
        //     $table->string('rentang', 255);
        //     $table->string('resolusi', 255);
        //     $table->double('bulan');
        //     $table->double('tahun');
        //     $table->string('status', 255);
        //     $table->timestamp('created_at')->useCurrent()->nullable();
        //     $table->timestamp('updated_at')->useCurrent()->nullable();
        // });

        Schema::create('sanitasi', function (Blueprint $table) {
            $table->bigIncrements('id_sanitasi');
            $table->integer('id_lokasi');
            $table->integer('id_item');
            $table->date('tgl');
            $table->string('admin', 100);
            $table->string('paraf_petugas', 100);
            $table->string('verifikator', 100);
        });

        Schema::create('foothbath_ceklis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_lokasi')->index();
            $table->date('tgl');
            $table->integer('id_frekuensi')->index();
            $table->string('paraf_petugas', 100)->nullable();
            $table->string('verifikator', 100)->nullable();
            $table->string('status', 100)->nullable();
            $table->string('admin', 100)->nullable();
        });

        Schema::create('foothbath_template', function (Blueprint $table) {
            $table->id();
            $table->string('item', 100);
            $table->string('frekuensi', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hrga6_perencanaan_sanitasi');
        Schema::dropIfExists('hrga7_identifikasi_limbah');
        Schema::dropIfExists('hrga7_pembuangan_sampah');
        Schema::dropIfExists('hrga7_pembuangan_tps');
        Schema::dropIfExists('hrga8_ceklist_pengecekan_air');
        Schema::dropIfExists('hrga8_ceklist_suhu_cold_storage');
        Schema::dropIfExists('hrga8_ceklist_suhu_ruangan');
        Schema::dropIfExists('hrga9_1kalibrasi');
    }
};

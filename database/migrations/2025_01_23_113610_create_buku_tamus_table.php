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
        Schema::create('buku_tamus', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal'); // Tanggal
            $table->string('nama'); // Nama
            $table->integer('suhu'); // Suhu
            $table->string('masker'); // Masker (ya/tidak)
            $table->string('alamat'); // Alamat
            $table->string('nomor_kendaraan'); // Nomor Kendaraan
            $table->string('keperluan'); // Keperluan
            $table->string('bertemu_dengan'); // Bertemu dengan siapa
            $table->time('time_in'); // Jam Masuk
            $table->time('time_out'); // Jam Keluar
            $table->string('visitor_signature'); // Path file tanda tangan pengunjung
            $table->string('admin'); // Path file tanda tangan pengunjung
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku_tamus');
    }
};

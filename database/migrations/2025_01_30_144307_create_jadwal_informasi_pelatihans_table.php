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
        Schema::create('jadwal_informasi_pelatihans', function (Blueprint $table) {
            $table->id();
            $table->string('tema_pelatihan');
            $table->integer('nota_pelatihan');
            $table->date('tanggal');
            $table->time('waktu');
            $table->string('tempat');
            $table->string('narasumber');
            $table->string('kisaran_materi');
            $table->integer('data_pegawais_id');
            $table->string('konfirmasi_keterangan');
            $table->enum('penyelenggara', ['internal', 'eksternal']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_informasi_pelatihans');
    }
};

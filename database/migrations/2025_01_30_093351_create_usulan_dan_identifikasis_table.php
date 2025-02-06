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
        Schema::create('usulan_dan_identifikasis', function (Blueprint $table) {
            $table->id();
            $table->integer('data_pegawais_id')->index();
            $table->integer('divisi_id');
            $table->string('pengusul');
            $table->string('usulan_jenis_pelatihan');
            $table->date('tanggal');
            $table->time('usulan_waktu');
            $table->string('alasan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usulan_dan_identifikasis');
    }
};

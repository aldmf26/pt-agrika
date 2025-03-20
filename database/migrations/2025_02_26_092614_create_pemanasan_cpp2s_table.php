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
        Schema::create('pemanasan_cpp2s', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->double('tray');
            $table->string('kode_batch');
            $table->string('jenis');
            $table->double('pcs');
            $table->double('gr');
            $table->double('tventing_c');
            $table->double('tventing_mnt');
            $table->double('ttot_c');
            $table->double('ttot_mnt');
            $table->string('keterangan');
            $table->timestamps();
        });
        Schema::create('ruangans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('suhu_sarang_walet_awal');
            $table->string('suhu_ruang');
            $table->string('penambahan_air');
            $table->string('mesin_pemanasan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemanasan_cpp2s');
    }
};

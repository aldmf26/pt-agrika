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
        Schema::create('pur3_tb_evaluasi', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id');
            $table->string('periode_evaluasi');
            $table->timestamps();
        });

        Schema::create('pur3_tb_detail_ketidaksesuaian', function (Blueprint $table) {
            $table->id();
            $table->integer('evaluasi_id')->index();
            $table->text('jenis_kriteria');
            $table->date('tanggal_ketidaksesuaian')->nullable();
            $table->text('alasan')->nullable();
            $table->double('penilaian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pur3_tb_evaluasi');
        Schema::dropIfExists('pur3_tb_detail_ketidaksesuaian');
    }
};

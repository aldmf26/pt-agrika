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
            $table->string('nama_supplier_outsource')->nullable();
            $table->string('produk_jasa');
            $table->string('periode_evaluasi');
            $table->decimal('ketepatan_kuantitas', 5, 2)->default(0);
            $table->integer('kuantitas_tidak_sesuai')->default(0);
            $table->decimal('ketepatan_waktu', 5, 2)->default(0);
            $table->integer('waktu_tidak_sesuai')->default(0);
            $table->decimal('ketepatan_kualitas', 5, 2)->default(0);
            $table->integer('kualitas_tidak_sesuai')->default(0);
            $table->decimal('harga_produk', 5, 2)->default(0);
            $table->decimal('kemudahan_komunikasi', 5, 2)->default(0);
            $table->date('tgl_evaluasi');
            $table->timestamps();
        });

        Schema::create('pur3_tb_detail_ketidaksesuaian', function (Blueprint $table) {
            $table->id();
            $table->integer('evaluasi_id')->index();
            $table->enum('jenis_kriteria', ['kuantitas', 'waktu', 'kualitas'])->notNullable();
            $table->date('tanggal_ketidaksesuaian')->nullable();
            $table->text('alasan')->nullable();
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

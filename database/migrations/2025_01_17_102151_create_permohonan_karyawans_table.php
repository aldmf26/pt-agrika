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
        Schema::create('permohonan_karyawans', function (Blueprint $table) {
            $table->id();
            $table->text('status_posisi');
            $table->text('jabatan');
            $table->unsignedBigInteger('id_divisi');
            $table->unsignedSmallInteger('jumlah');
            $table->text('alasan_penambahan');
            $table->unsignedSmallInteger('umur');
            $table->string('jenis_kelamin');
            $table->string('pendidikan');
            $table->string('pengalaman');
            $table->string('pelatihan');
            $table->string('mental');
            $table->text('uraian_kerja');
            $table->date('tgl_dibutuhkan');
            $table->string('diajukan_oleh');
            $table->dateTime('tgl_input');
            $table->string('admin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_karyawans');
    }
};

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
        Schema::create('pengeringans', function (Blueprint $table) {
            $table->id();
            $table->integer('pegawai_id');
            $table->string('no_box');
            $table->date('tanggal');
            $table->string('grade');
            $table->double('pcs');
            $table->double('gr');
            $table->double('pcs_akhir');
            $table->double('gr_akhir');
            $table->double('hcr');
            $table->string('ket');
            $table->string('pengawas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeringans');
    }
};

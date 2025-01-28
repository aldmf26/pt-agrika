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
        Schema::create('permintaan_perbaikan_sarana_prasana', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id')->index();
            $table->string('invoice_pengajuan')->index();
            $table->string('diajukan_oleh');
            $table->date('tanggal');
            $table->time('waktu');
            $table->text('deskripsi_masalah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_perbaikan_sarana_prasana');
    }
};

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
        Schema::create('jadwal_kalibrasi', function (Blueprint $table) {
            $table->id();
            $table->integer('item_kalibrasi_id')->index();
            $table->string('frekuensi');
            $table->string('rentang');
            $table->string('resolusi');
            $table->date('tanggal');
            $table->string('standar_nilai');
            $table->string('aktual_nilai');
            $table->string('status');
            $table->date('tanggal_selanjutnya');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

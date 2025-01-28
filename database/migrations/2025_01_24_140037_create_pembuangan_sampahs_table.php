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
        Schema::create('pembuangan_sampahs', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_sampah')->nullable();
            $table->date('tgl')->nullable();
            $table->string('jam_cek')->nullable();
            $table->string('paraf_petugas')->nullable();
            $table->string('ket')->nullable();
            $table->string('admin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembuangan_sampahs');
    }
};

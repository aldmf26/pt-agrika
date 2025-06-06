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
        Schema::create('jadwal_verifikasis', function (Blueprint $table) {
            $table->id();
            $table->string('item');
            $table->string('aktivitas');
            $table->string('frek');
            $table->string('departemen');
            $table->tinyInteger('bulan_1');
            $table->tinyInteger('bulan_2');
            $table->tinyInteger('bulan_3');
            $table->tinyInteger('bulan_4');
            $table->tinyInteger('bulan_5');
            $table->tinyInteger('bulan_6');
            $table->tinyInteger('bulan_7');
            $table->tinyInteger('bulan_8');
            $table->tinyInteger('bulan_9');
            $table->tinyInteger('bulan_10');
            $table->tinyInteger('bulan_11');
            $table->tinyInteger('bulan_12');
            $table->double('tahun');
            $table->string('admin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_verifikasis');
    }
};

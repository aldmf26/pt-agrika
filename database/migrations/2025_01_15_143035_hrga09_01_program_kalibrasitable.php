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
        Schema::create('hrga9_1kalibrasi', function (Blueprint $table) {
            $table->id();
            $table->integer('item_kalibrasi_id')->index();
            $table->string('frekuensi');
            $table->double('minimum');
            $table->double('maksimum');
            $table->double('resolusi');
            $table->double('bulan');
            $table->double('tahun');
            $table->string('status');
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

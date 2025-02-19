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
        Schema::create('penerimaan_kemasan_sbw_kotor_header', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->string('no_lot');
            $table->date('tgl_penerimaan');
            $table->string('alamat_rumah_walet');
            $table->string('no_kendaraan');
            $table->string('pengemudi');
            $table->double('jumlah_gr');
            $table->double('jumlah_pcs');
            $table->string('keputusan');
            $table->string('noreg_rumah_walet');
            $table->string('admin');
            $table->timestamps();
        });

        Schema::create('penerimaan_kemasan_sbw_kotor_kriteria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penerimaan');
            $table->string('kriteria');
            $table->boolean('check_1')->default(false);
            $table->boolean('check_2')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerimaan_kemasan_sbw_kotor_header');
        Schema::dropIfExists('penerimaan_kemasan_sbw_kotor_kriteria');
    }
};

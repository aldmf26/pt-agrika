<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ikph', function (Blueprint $table) {
            $table->id();
            $table->string('no_registrasi_ikph');
            $table->string('nama_ikph');
            $table->text('alamat_ikph');
            $table->timestamps();
        });

        DB::table('ikph')->insert(
            [
                'no_registrasi_ikph' => '1',
                'nama_ikph' => 'IKPH 1',
                'alamat_ikph' => 'Jl. IKPH 1, RT 1 RW 1, Kec. Kecamatan, Kota Kota',
            ]
        );


        // Tabel untuk pencatatan panen dan pengiriman
        Schema::create('sk_pengiriman_walet', function (Blueprint $table) {
            $table->id();
            // Referensi ke tabel penerimaan yang sudah ada
            $table->foreignId('id_penerimaan');
            // Data IKPH tujuan
            $table->foreignId('id_ikph');
            $table->date('tanggal_sk_pengiriman');
            $table->string('tujuan_ikph');

            // Informasi panen
            $table->date('tanggal_panen');
            $table->decimal('berat_panen', 10, 2); // dalam kg

            // Informasi pengiriman
            $table->date('tanggal_kirim')->nullable();
            $table->decimal('berat_kirim', 10, 2)->nullable(); // dalam kg

            $table->text('keterangan')->nullable();
            $table->string('admin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sk_pengiriman_walet');
        Schema::dropIfExists('ikph');
    }
};

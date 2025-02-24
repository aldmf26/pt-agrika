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
        // Tabel Barang
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang', 50)->unique();
            $table->string('nama_barang', 100);
            $table->string('satuan', 100);
            $table->string('kategori');
            $table->string('tipe_sbw')->nullable();
            $table->double('stok');
            $table->integer('supplier_id')->nullable();
            $table->integer('rumah_walet_id')->nullable();
            $table->timestamps();
        });

        // Tabel Supplier
        Schema::create('supplier', function (Blueprint $table) {
            $table->id();
            $table->string('nama_supplier', 100);
            $table->timestamps();
        });

        // Tabel Header Penerimaan
        Schema::create('penerimaan_header', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_terima');
            $table->foreignId('id_barang')->constrained('barang');
            $table->foreignId('id_supplier')->constrained('supplier');
            $table->string('no_kendaraan', 20);
            $table->string('pengemudi', 100);
            $table->integer('jumlah_barang');
            $table->string('kode_lot', 50)->nullable();
            $table->string('status_penerimaan');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });

        // Tabel Detail Kriteria Penerimaan  
        Schema::create('penerimaan_kriteria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penerimaan');
            $table->enum('kriteria', ['quantity', 'visual']);
            $table->boolean('check_1')->default(false);
            $table->boolean('check_2')->default(false);
            $table->boolean('check_3')->default(false);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerimaan_kriteria');
        Schema::dropIfExists('penerimaan_header');
        Schema::dropIfExists('supplier');
        Schema::dropIfExists('barang');
    }
};

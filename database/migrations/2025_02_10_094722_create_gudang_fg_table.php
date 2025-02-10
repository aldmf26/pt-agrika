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
        // Tabel Profil Perusahaan
        Schema::create('profil_perusahaan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan', 100);
            $table->string('telepon', 20)->nullable();
            $table->string('fax', 20)->nullable();
            $table->timestamps();
        });

        // Tabel Pelanggan
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan', 100);
            $table->text('alamat');
            $table->timestamps();
        });

        
        // Tabel Produk
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk', 100);
            $table->string('kode_produk', 50);
            $table->string('grade', 10)->nullable();
            $table->string('satuan', 50)->nullable();
            $table->timestamps();
        });

        // Tabel Gudang
        Schema::create('gudang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_gudang', 20);
            $table->string('nama_gudang', 100);
            $table->timestamps();
        });

        // Tabel Surat Jalan
        Schema::create('surat_jalan', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_order', 20);
            $table->date('tanggal_order');
            $table->foreignId('id_pelanggan');
            $table->string('nomor_kendaraan', 20)->nullable();
            $table->string('nama_supir', 100)->nullable();
            $table->string('dibuat_oleh', 100);
            $table->string('disetujui_oleh', 100);
            $table->string('pengirim', 100);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // Tabel Detail Surat Jalan
        Schema::create('detail_surat_jalan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_surat_jalan');
            $table->foreignId('id_produk');
            $table->decimal('jumlah', 10, 2);
            $table->string('satuan', 50);
            $table->boolean('perlu_coa')->default(false);
            $table->timestamps();
        });

        // Tabel Penerimaan Barang
        Schema::create('penerimaan_barang', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_terima');
            $table->foreignId('id_produk');
            $table->decimal('jumlah', 10, 2);
            $table->string('satuan', 50);
            $table->string('nomor_batch', 50);
            $table->string('barcode', 100)->nullable();
            $table->date('tanggal_produksi');
            $table->string('status', 20);
            $table->string('diterima_oleh', 100);
            $table->timestamps();
        });

        // Tabel Kartu Stok
        Schema::create('kartu_stok', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_produk');
            $table->date('tanggal_transaksi');
            $table->decimal('stok_masuk', 10, 2)->default(0);
            $table->decimal('stok_keluar', 10, 2)->default(0);
            $table->decimal('stok_akhir', 10, 2);
            $table->string('nomor_batch', 50);
            $table->string('gudang', 50);
            $table->string('ttd_petugas', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kartu_stok');
        Schema::dropIfExists('penerimaan_barang');
        Schema::dropIfExists('detail_surat_jalan');
        Schema::dropIfExists('surat_jalan');
        Schema::dropIfExists('gudang');
        Schema::dropIfExists('produk');
        Schema::dropIfExists('pelanggan');
        Schema::dropIfExists('profil_perusahaan');
    }
};

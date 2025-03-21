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
        Schema::create('purchase_requests', function (Blueprint $table) {
            $table->id();
            $table->string('no_pr', 20);
            $table->date('tgl');
            $table->string('diminta_oleh', 100);
            $table->string('posisi', 100)->nullable();
            $table->string('departemen', 100)->nullable();
            $table->string('manager_departemen', 100)->nullable();
            $table->text('alasan_permintaan')->nullable();
            $table->enum('status', ['draft', 'disetujui', 'ditolak', 'diproses'])->default('draft');
            $table->timestamps();
        });

        Schema::create('purchase_request_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pr_id');
            $table->integer('jumlah');
            $table->text('item_spesifikasi');
            $table->date('tgl_dibutuhkan')->nullable();
            $table->timestamps();
        });

        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('no_po', 20);
            $table->date('tgl');
            $table->string('supplier', 100);
            $table->text('alamat_pengiriman')->nullable();
            $table->string('pic', 100)->nullable();
            $table->string('telp', 20)->nullable();
            $table->date('estimasi_kedatangan')->nullable();
            $table->decimal('total_harga', 15, 2)->default(0);
            $table->unsignedBigInteger('pr_id')->nullable();
            $table->enum('status', ['draft', 'terkirim', 'selesai'])->default('draft');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
        Schema::dropIfExists('purchase_request_items');
        Schema::dropIfExists('purchase_requests');
    }
};

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
        Schema::create('recalls', function (Blueprint $table) {
            $table->id();
            $table->string('no_nota')->nullable();
            $table->text('skenario_recall')->nullable();
            $table->string('dibuat_oleh')->nullable();
            $table->timestamps();
        });

        // Table 2: recall_team_members (anggota tim recall)
        Schema::create('recall_team_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recall_id')->constrained('recalls')->onDelete('cascade');
            $table->string('nama');
            $table->string('tugas');
            $table->timestamps();
        });

        // Table 3: recall_products (produk yang direcall)
        Schema::create('recall_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recall_id')->constrained('recalls')->onDelete('cascade');
            $table->string('nama');
            $table->string('no_lot')->nullable();
            $table->decimal('jumlah_recall', 15, 2)->nullable();
            $table->decimal('jumlah_distribusi', 15, 2)->nullable();
            $table->string('nama_pelanggan')->nullable();
            $table->string('alamat_pelanggan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recall_products');
        Schema::dropIfExists('recall_team_members');
        Schema::dropIfExists('recalls');
    }
};

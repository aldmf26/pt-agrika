<?php

use Illuminate\Container\Attributes\DB;
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
        Schema::create('checklist_items', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Nama item (kategori, sub-kategori, atau item checklist)
            $table->foreignId('parent_id')->nullable()->constrained('checklist_items')->onDelete('cascade');// Hierarki dengan parent_id
            $table->integer('order'); // Urutan item untuk ditampilkan
            $table->timestamps();
        });

        // Tabel checklists
        Schema::create('checklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('checklist_items')->onDelete('cascade');
            $table->foreignId('department_id');
            $table->boolean('min')->default(0); // Status MIN
            $table->boolean('maj')->default(0); // Status MAJ
            $table->boolean('sr')->default(0);  // Status SR
            $table->boolean('kt')->default(0);  // Status KT
            $table->boolean('ok')->default(0);  // Status OK
            $table->text('notes')->nullable(); // Catatan tambahan (opsional)
            $table->timestamp('checked_at')->nullable(); // Waktu checklist dilakukan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checklist_items');
        Schema::dropIfExists('checklists');
    }
};

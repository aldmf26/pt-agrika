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
        Schema::create('data_pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 50)->unique(); // Kode unik karyawan
            $table->string('nama', 100);            // Nama depan
            $table->string('email', 150)->unique()->nullable(); // Email (opsional)
            $table->string('no_telepon', 15)->nullable();    // Nomor telepon
            $table->date('tgl_lahir')->nullable();          // Tanggal lahir
            $table->date('tgl_masuk');                 // Tanggal mulai bergabung
            $table->unsignedBigInteger('divisi_id')->nullable(); // Referensi departemen
            $table->string('posisi', 100)->nullable();         // Jabatan
            $table->enum('status', ['kontrak', 'borongan', 'tetap'])->default('kontrak'); // Status kerja
            $table->decimal('gaji', 15, 2)->nullable();         // Gaji
            $table->string('pendidikan', 100)->nullable();      // Pendidikan terakhir
            $table->string('sumber_data', 100)->nullable();      // Pendidikan terakhir
            $table->integer('karyawan_id_dari_api')->nullable();      // Pendidikan terakhir
            $table->string('keterangan', 200)->nullable();      // Pendidikan terakhir
            $table->string('admin', 200);      // Pendidikan terakhir
            $table->timestamps();
        });

        // Tabel departemen
        Schema::create('departemen', function (Blueprint $table) {
            $table->id();
            $table->string('divisi', 100); // Nama departemen
            $table->text('urutan')->nullable();  // Deskripsi departemen
            $table->text('deskripsi')->nullable(); 
            $table->timestamps();
        });

        // Tabel riwayat gaji
        Schema::create('riwayat_gaji', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id');          // Referensi ke tabel karyawan
            $table->decimal('gaji_sebelumnya', 15, 2)->nullable(); // Gaji sebelum perubahan
            $table->decimal('gaji_baru', 15, 2);                // Gaji setelah perubahan
            $table->date('tanggal_berlaku');                    // Tanggal mulai berlaku
            $table->text('alasan_perubahan')->nullable();       // Alasan perubahan gaji
            $table->timestamps();

        });

        // Tabel riwayat jabatan
        Schema::create('riwayat_jabatan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id');          // Referensi ke tabel karyawan
            $table->string('jabatan_sebelumnya', 100)->nullable(); // Jabatan sebelumnya
            $table->string('jabatan_baru', 100);                // Jabatan baru
            $table->date('tanggal_perubahan');                  // Tanggal perubahan
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pegawais');
        Schema::dropIfExists('divisis');
        Schema::dropIfExists('riwayat_jabatan');
        Schema::dropIfExists('riwayat_gaji');
    }
};

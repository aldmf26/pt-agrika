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

        Schema::create('hrga2_sum_penilaian_kompetensi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('karyawan_id');
            $table->string('nama_karyawan');
            $table->string('departemen');
            $table->year('tahun');
            $table->integer('total_nilai')->default(0);
            $table->string('kategori_nilai')->nullable(); // Baik Sekali, Baik, Cukup, Kurang
            $table->text('rekomendasi')->nullable();
            $table->string('status')->default('draft'); // draft, submitted, approved
            $table->string('penilai')->nullable();
            $table->date('tanggal_penilaian')->nullable();
            $table->timestamps();

            // Index untuk performa
            $table->unique(['karyawan_id', 'tahun']); // Fix: Unik per karyawan per tahun
            $table->index(['departemen', 'tahun']);
        });

        // 2. Penilaian Kompetensi (Checklist)
        Schema::create('hrga2_penilaian_kompetensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penilaian_id');
            $table->string('kompetensi');
            $table->boolean('aktual')->default(false);
            $table->boolean('tidak_lanjut')->default(false);
            $table->timestamps();
        });

        // 3. Catatan Kehadiran
        Schema::create('hrga2_catatan_kehadiran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penilaian_id');
            $table->string('keterangan'); // Terlambat, Sakit, Tanpa Keterangan, Izin
            $table->integer('tahun'); // 1-12
            $table->integer('bulan'); // 1-12
            $table->integer('hari')->default(0);
            $table->integer('jam')->default(0);
            $table->timestamps();

            $table->index(['bulan', 'tahun']);
        });

        // 4. Penilaian Parameter
        Schema::create('hrga2_penilaian_parameter', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penilaian_id');
            $table->string('parameter');
            $table->integer('nilai')->default(0);
            $table->timestamps();


            $table->index(['parameter']);
        });

        // 5. Surat Peringatan (SP)
        Schema::create('hrga2_surat_peringatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penilaian_id');
            $table->integer('sp_1')->default(0);
            $table->integer('sp_2')->default(0);
            $table->integer('sp_3')->default(0);
            $table->integer('total_sp')->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // 6. Rekomendasi
        Schema::create('hrga2_master_kompetensi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });

        Schema::create('hrga2_master_parameter', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        // Insert default data (dalam transaction biar aman)
        DB::transaction(function () {
            // Insert default kompetensi (pastikan tabel master_kompetensi ada)
            if (!DB::table('hrga2_master_kompetensi')->where('nama', 'Menguasai pekerjaan di divisinya')->exists()) {
                DB::table('hrga2_master_kompetensi')->insert([
                    ['nama' => 'Menguasai pekerjaan di divisinya', 'aktif' => true],
                    ['nama' => 'Tidak pernah melakukan kecerobohan dalam pekerjaannya', 'aktif' => true],
                    ['nama' => 'Telah mendapat training HACCP, GMP, CCP', 'aktif' => true],
                ]);
            }

            // Insert default parameter penilaian (pastikan tabel master_parameter ada)
            if (!DB::table('hrga2_master_parameter')->where('nama', 'Disiplin')->exists()) {
                DB::table('hrga2_master_parameter')->insert([
                    ['nama' => 'Disiplin', 'urutan' => 1],
                    ['nama' => 'Sikap Kerja', 'urutan' => 2],
                    ['nama' => 'Kerjasama', 'urutan' => 3],
                    ['nama' => 'Tanggung Jawab', 'urutan' => 4],
                    ['nama' => 'Kesopanan', 'urutan' => 5],
                    ['nama' => 'Kejujuran', 'urutan' => 6],
                    ['nama' => 'Kerapian', 'urutan' => 7],
                    ['nama' => 'Inisiatif', 'urutan' => 8],
                    ['nama' => 'Pengetahuan', 'urutan' => 9],
                    ['nama' => 'Keahlian', 'urutan' => 10],
                    ['nama' => 'Leadership', 'urutan' => 11],
                    ['nama' => 'Manajerial', 'urutan' => 12],
                ]);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sum_penilaian_kompetensi');
        Schema::dropIfExists('penilaian_kompetensi');
        Schema::dropIfExists('catatan_kehadiran');
        Schema::dropIfExists('penilaian_parameter');
        Schema::dropIfExists('surat_peringatan');
        Schema::dropIfExists('master_kompetensi');
        Schema::dropIfExists('master_parameter');
    }
};

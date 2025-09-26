<?php

use App\Models\Pertanyaan;
use App\Models\PertanyaanSurvey;
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
        Schema::create('responden_survey', function (Blueprint $table) {
            $table->id();
            $table->enum('gender', ['L', 'P'])->comment('L = Laki-laki, P = Perempuan');
            $table->string('bagian_pekerjaan', 50)->comment('e.g., Management, Staff, Produksi');
            $table->date('tanggal_survei');
            $table->timestamps();
        });

        Schema::create('pertanyaan_survey', function (Blueprint $table) {
            $table->id();
            $table->integer('no_pertanyaan')->comment('Nomor urut pertanyaan 1-18');
            $table->string('kategori', 50)->comment('e.g., KEAMANAN, TANGGUNG JAWAB, KEBERSAMAAN');
            $table->string('sub_kategori', 50)->comment('e.g., KOMITMEN MANAGEMENT, TEAMWORK');
            $table->text('teks_pertanyaan');
            $table->string('catatan', 100)->nullable()->comment('e.g., Training, Komunikasi');
            $table->timestamps();
        });

        Schema::create('jawaban_survey', function (Blueprint $table) {
            $table->id();
            $table->foreignId('responden_id');
            $table->foreignId('pertanyaan_id');
            $table->integer('nilai')->unsigned()->comment('Skala 1-5: 5=Sangat Benar, 1=Tidak Benar Sama Sekali');
            $table->timestamps();
        });

        $pertanyaan = [
            ['no_pertanyaan' => 1, 'kategori' => 'KEAMANAN', 'sub_kategori' => 'KOMITMEN MANAGEMENT', 'teks_pertanyaan' => 'Ada perhatian dari manajemen bagi karyawan yang konsisten melaksanakan budaya keamanan produk (komitmen management)', 'catatan' => 'Training'],
            ['no_pertanyaan' => 2, 'kategori' => 'KEAMANAN', 'sub_kategori' => 'KOMITMEN MANAGEMENT', 'teks_pertanyaan' => 'Ada sistem/cara yang jelas dan terukur untuk memastikan bahwa budaya keamanan pangan dilakukan di perusahaan telah baik (komitmen management)', 'catatan' => 'Training'],
            ['no_pertanyaan' => 3, 'kategori' => 'KEAMANAN', 'sub_kategori' => 'TEAMWORK', 'teks_pertanyaan' => 'Apabila ada rekan yang melanggar, maka rekan yang lain akan mengingatkan (teamwork)', 'catatan' => 'Komunikasi'],
            ['no_pertanyaan' => 4, 'kategori' => 'KEAMANAN', 'sub_kategori' => 'TEAMWORK', 'teks_pertanyaan' => 'Semua karyawan bekerjasama dalam mendukung pelaksanaan budaya keamanan pangan (teamwork)', 'catatan' => null],
            ['no_pertanyaan' => 5, 'kategori' => 'KEAMANAN', 'sub_kategori' => 'PEMBERDAYAAN', 'teks_pertanyaan' => 'Semua karyawan mendukung pelaksanaan budaya keamanan pangan (pemberdayaan)', 'catatan' => null],
            ['no_pertanyaan' => 6, 'kategori' => 'KEAMANAN', 'sub_kategori' => 'PEMBERDAYAAN', 'teks_pertanyaan' => 'Semua karyawan terlibat secara aktif dalam budaya keamanan pangan (pemberdayaan)', 'catatan' => null],
            ['no_pertanyaan' => 7, 'kategori' => 'TANGGUNG JAWAB', 'sub_kategori' => 'KONTROL', 'teks_pertanyaan' => 'Pelaksanaan Budaya keamanan pangan ini diawasi (kontrol)', 'catatan' => null],
            ['no_pertanyaan' => 8, 'kategori' => 'TANGGUNG JAWAB', 'sub_kategori' => 'KONTROL', 'teks_pertanyaan' => 'Pengawasan dilakukan oleh rekan kerja, atasan dan top manajemen (kontrol)', 'catatan' => null],
            ['no_pertanyaan' => 9, 'kategori' => 'TANGGUNG JAWAB', 'sub_kategori' => 'KOORDINASI', 'teks_pertanyaan' => 'Semua karyawan, staff dan top manajemen memiliki persepsi yang sama terkait dengan budaya keamanan pangan (koordinasi)', 'catatan' => null],
            ['no_pertanyaan' => 10, 'kategori' => 'TANGGUNG JAWAB', 'sub_kategori' => 'KOORDINASI', 'teks_pertanyaan' => 'Semua karyawan, staf dan top manajemen bekerjasama dengan baik dalam mensukseskan budaya keamanan pangan di perusahaan (koordinasi)', 'catatan' => null],
            ['no_pertanyaan' => 11, 'kategori' => 'TANGGUNG JAWAB', 'sub_kategori' => 'KONSISTENSI', 'teks_pertanyaan' => 'Semua karyawan, staff dan top manajemen secara mandiri menerapkan budaya keamanan pangan di area masing masing (konsistensi)', 'catatan' => null],
            ['no_pertanyaan' => 12, 'kategori' => 'TANGGUNG JAWAB', 'sub_kategori' => 'KONSISTENSI', 'teks_pertanyaan' => 'Penerapan budaya keamanan pangan tetap dilakukan dengan pengawasan yang minimum (konsistensi)', 'catatan' => null],
            ['no_pertanyaan' => 13, 'kategori' => 'KEBERSAMAAN', 'sub_kategori' => 'KEPEDULIAN', 'teks_pertanyaan' => 'Teman anda sangat peduli dan menerapkan budaya keamanan pangan yang ditetapkan (kepedulian)', 'catatan' => null],
            ['no_pertanyaan' => 14, 'kategori' => 'KEBERSAMAAN', 'sub_kategori' => 'KEPEDULIAN', 'teks_pertanyaan' => 'Atasan anda memberi contoh pelaksanan budaya keamanan pangan dengan konsisten (kepedulian)', 'catatan' => null],
            ['no_pertanyaan' => 15, 'kategori' => 'KEBERSAMAAN', 'sub_kategori' => 'KOMUNIKASI', 'teks_pertanyaan' => 'Semua standard budaya keamanan pangan sudah di komunikasikan kepada semua karyawan (komunikasi)', 'catatan' => null],
            ['no_pertanyaan' => 16, 'kategori' => 'KEBERSAMAAN', 'sub_kategori' => 'KOMUNIKASI', 'teks_pertanyaan' => 'Anda tahu tentang budaya yang di kembangkan di perusahaan (komunikasi)', 'catatan' => null],
            ['no_pertanyaan' => 17, 'kategori' => 'KEBERSAMAAN', 'sub_kategori' => 'TARGET', 'teks_pertanyaan' => 'Semua karyawan tahu target apa dan berapa yang ingin dicapai perusahaan (target)', 'catatan' => null],
            ['no_pertanyaan' => 18, 'kategori' => 'KEBERSAMAAN', 'sub_kategori' => 'TARGET', 'teks_pertanyaan' => 'Target yang ditetapkan oleh perusahaan terukur (bisa dinilai) pencapaiannya (target)', 'catatan' => null],
        ];

        DB::table('pertanyaan_survey')->truncate();
        DB::table('pertanyaan_survey')->insert($pertanyaan);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responden_survey');
        Schema::dropIfExists('pertanyaan_survey');
        Schema::dropIfExists('jawaban_survey');
    }
};

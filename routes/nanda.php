<?php

use App\Http\Controllers\Hrga\Hrga2PenilaianKompetensi\Hrga5JadwalGapAnalysis;
use App\Http\Controllers\Hrga\Hrga3Pelatihan\Hrga1InformasiTawaranPelatihan;
use App\Http\Controllers\Hrga\Hrga3Pelatihan\Hrga2ProgramPelatihanTahunan;
use App\Http\Controllers\Hrga\Hrga3Pelatihan\Hrga3UsulandanIdentifikasi;
use App\Http\Controllers\Hrga\Hrga3Pelatihan\Hrga4JadwalDanInformasiPelatihan;
use App\Http\Controllers\Hrga\Hrga3Pelatihan\Hrga5DaftarHadirPelatihanController;
use App\Http\Controllers\Hrga\Hrga3Pelatihan\Hrga6EvaluasiPelatihan;
use App\Http\Controllers\Hrga\Hrga4MedicalScreening\Hrga1JadwalMedicalCheckup;
use App\Http\Controllers\Hrga\Hrga5PerbaikandanPerawatanSaranaPrasarana\Hrga1ProgramPerawatanSaranadanPrasaranaUmum;
use App\Http\Controllers\Hrga\Hrga5PerbaikandanPerawatanSaranaPrasarana\Hrga2RiwayatPerwatanPerbaikan;
use App\Http\Controllers\Hrga\Hrga5PerbaikandanPerawatanSaranaPrasarana\Hrga3PermintaanPerbaikan;
use App\Http\Controllers\Hrga\Hrga8PerawatanDanPerbaikanMesin\Hrga1ProgramPerawatanMesin;
use App\Http\Controllers\Hrga\Hrga8PerawatanDanPerbaikanMesin\Hrga2CeklisPerawatanMesin;
use App\Http\Controllers\Hrga\Hrga8PerawatanDanPerbaikanMesin\Hrga3PermintaanPerbaikanMesin;
use App\Http\Controllers\Hrga\Hrga9ProgramKalibrasi\Hrga2JadwalKalibrasiVerfikasi;
use App\Http\Controllers\Hrga\Hrga9ProgramKalibrasi\Hrga1ProgramKalibrasi;
use App\Http\Controllers\PPC\Gudang_FG\FG2CheklistKendaraanController;
use App\Http\Controllers\produksi\Pro10PenimbanganHasilProduksi;
use App\Http\Controllers\Produksi\Pro11FormPengemasanAkhirController;
use App\Http\Controllers\Produksi\Pro1PersiapandanPembersihanController;
use App\Http\Controllers\Produksi\Pro2FormSerahTerimaBahanBaku;
use App\Http\Controllers\Produksi\Pro3FormPencabutanBulu;
use App\Http\Controllers\Produksi\Pro4FormPenyucianNitrit;
use App\Http\Controllers\Produksi\Pro5FormPengeringan;
use App\Http\Controllers\Produksi\Pro6FormCetak;
use App\Http\Controllers\Produksi\Pro7FormPemilahanAkhir;
use App\Http\Controllers\Produksi\Pro8Totalhasilgrading;
use App\Http\Controllers\Produksi\Pro9Ccp2Pemanasan;
use App\Http\Controllers\PUR\SeleksiSupplier\PUR2SeleksiSupplier;
use App\Http\Controllers\QA\MampuTelusur\TraceabilityController;
use App\Http\Controllers\QA\PenarikanProduk\RecallProdukController;
use App\Http\Controllers\QA\TinjauanManajemen\AgendadanJadwalTinjauanManajemenController;
use App\Http\Controllers\QA\TinjauanManajemen\DaftarhadirTinjuanManajemenController;
use App\Http\Controllers\QA\TinjauanManajemen\NotulenTinjauanManajemenController;
use App\Http\Controllers\QA\Verifikasi\JadwalVerifikasiController;
use App\Http\Controllers\Qc\KontrolGrading;
use App\Http\Controllers\Qc\KontrolPengemasanController;
use App\Http\Controllers\Qc\LaporanPelaksanaanEksporController;
use App\Http\Controllers\Qc\LaporanPenggunaanInstalasiKarantinaHewan;
use App\Http\Controllers\Qc\MonitoringMuatProdukJadi;
use App\Http\Controllers\Qc\PemeriksaanRetail;
use App\Http\Controllers\Qc\PengecekanWaktuPencucianTerakhir;
use App\Http\Controllers\Qc\PerencanaanSwabController;
use App\Http\Controllers\QC\ProdukReleaseController;
use App\Http\Controllers\Qc\ReleaseCuciTerakhir;
use App\Http\Controllers\ReleaseSteamingController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
use App\Models\LaporanPenggunaanInstalasiKarantina;
use Illuminate\Support\Facades\Route;




Route::controller(Hrga1InformasiTawaranPelatihan::class)
    ->prefix('hrga/hrga3/hrga3.1_Informasi_tawaran_pelatihan')
    ->name('hrga3.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
        Route::post('/store', 'store')->name('store');
    });
Route::controller(Hrga2ProgramPelatihanTahunan::class)
    ->prefix('hrga/hrga3/hrga3.2_Program_pelatihan_tahunan')
    ->name('hrga3.2.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
        Route::post('/store', 'store')->name('store');
    });
Route::controller(Hrga3UsulandanIdentifikasi::class)
    ->prefix('hrga/hrga3/hrga3.3_Usulan_dan_identifikasi_kebutuhan_pelatihan')
    ->name('hrga3.3.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/getPegawai', 'getPegawai')->name('getPegawai');
        Route::post('/store', 'store')->name('store');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(Hrga4JadwalDanInformasiPelatihan::class)
    ->prefix('hrga/hrga3/hrga3.4_Jadwal_dan_informasi_pelatihan')
    ->name('hrga3.4.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
        Route::post('/store', 'store')->name('store');
    });
Route::controller(Hrga5DaftarHadirPelatihanController::class)
    ->prefix('hrga/hrga3/hrga3.5_Daftar_hadir_pelatihan')
    ->name('hrga3.5.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(Hrga6EvaluasiPelatihan::class)
    ->prefix('hrga/hrga3/hrga3.6_Evaluasi_pelatihan')
    ->name('hrga3.6.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(Hrga1JadwalMedicalCheckup::class)
    ->prefix('hrga/hrga4/hrga4.1_Jadwal_medical_checkup')
    ->name('hrga4.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/getPegawai', 'getPegawai')->name('getPegawai');
        Route::get('/print', 'print')->name('print');
        Route::post('/store', 'store')->name('store');
    });
Route::controller(Hrga1ProgramPerawatanSaranadanPrasaranaUmum::class)
    ->prefix('hrga/hrga5/hrga5.1_Program_perawatan_sarana_dan_prasarana_umum')
    ->name('hrga5.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/get_item', 'get_item')->name('get_item');
        Route::get('/get_merk', 'get_merk')->name('get_merk');
        Route::post('/store', 'store')->name('store');
        Route::get('/print', 'print')->name('print');
        Route::get('/copy', 'copy')->name('copy');
    });
Route::controller(Hrga2RiwayatPerwatanPerbaikan::class)
    ->prefix('hrga/hrga5/hrga5.2_Riwayat_perwatan_dan_perbaikan_sarana_dan_prasarana_umum')
    ->name('hrga5.2.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(Hrga3PermintaanPerbaikan::class)
    ->prefix('hrga/hrga5/hrga5.3_Permintaan_perbaikan_sarana_dan_prasarana_umum')
    ->name('hrga5.3.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/formPermintaanperbaikan', 'formPermintaanperbaikan')->name('formPermintaanperbaikan');
        Route::get('/sukses', 'sukses')->name('sukses');
        Route::post('/store', 'store')->name('store');
        Route::get('/print', 'print')->name('print');
    });

Route::controller(Hrga1ProgramPerawatanMesin::class)
    ->prefix('hrga/hrga8/1_Program_perawatan_mesin')
    ->name('hrga8.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
        Route::post('/store', 'store')->name('store');
    });
Route::controller(Hrga2CeklisPerawatanMesin::class)
    ->prefix('hrga/hrga8/2_Ceklis_perawatan_mesin')
    ->name('hrga8.2.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/add', 'add')->name('add');
        Route::post('/store', 'store')->name('store');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(Hrga3PermintaanPerbaikanMesin::class)
    ->prefix('hrga/hrga8/3_Permintaan_perbaikan_mesin')
    ->name('hrga8.3.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/formpengajuan', 'formpengajuan')->name('formpengajuan');
        Route::get('/sukses', 'sukses')->name('sukses');
        Route::get('/print', 'print')->name('print');
        Route::post('/store', 'store')->name('store');
    });

Route::controller(Hrga1ProgramKalibrasi::class)
    ->prefix('hrga/hrga9/hrga9.1_Program_Kalibrasi')
    ->name('hrga9.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/itemKalibrasi/{id}', 'itemKalibrasi')->name('itemKalibrasi');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(Hrga2JadwalKalibrasiVerfikasi::class)
    ->prefix('hrga/hrga9/hrga9.2_Jadwal_Kalibrasi')
    ->name('hrga9.2.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
        Route::post('/store', 'store')->name('store');
    });

Route::controller(Pro1PersiapandanPembersihanController::class)
    ->prefix('produksi/1_Persiapan_dan_Pembersihan')
    ->name('produksi.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(Pro2FormSerahTerimaBahanBaku::class)
    ->prefix('produksi/2_Form_Serah_Terima_Bahan_Baku_Ke_Pencabutan')
    ->name('produksi.2.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(Pro3FormPencabutanBulu::class)
    ->prefix('produksi/3_Form_Pencabutan_Bulu_dan_Laporan_Harian')
    ->name('produksi.3.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(Pro4FormPenyucianNitrit::class)
    ->prefix('produksi/4_Form_Penyucian_Nitrit')
    ->name('produksi.4.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(Pro5FormPengeringan::class)
    ->prefix('produksi/5_Form_Pengeringan')
    ->name('produksi.5.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
        Route::post('/store', 'store')->name('store');
    });
Route::controller(Pro6FormCetak::class)
    ->prefix('produksi/6_Form_cetak')
    ->name('produksi.6.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(Pro7FormPemilahanAkhir::class)
    ->prefix('produksi/7_Form_pemilahan_akhir')
    ->name('produksi.7.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(Pro8Totalhasilgrading::class)
    ->prefix('produksi/8_total_hasil_grading')
    ->name('produksi.8.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(Pro9Ccp2Pemanasan::class)
    ->prefix('produksi/9_CCP2_Pemanasan')
    ->name('produksi.9.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(Pro10PenimbanganHasilProduksi::class)
    ->prefix('produksi/10_Penimbangan_Hasil_Produksi')
    ->name('produksi.10.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(Pro11FormPengemasanAkhirController::class)
    ->prefix('produksi/11_Pengemasan_Akhir')
    ->name('produksi.11.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(AgendadanJadwalTinjauanManajemenController::class)
    ->prefix('qa/tinjauan_manajemen/agendadan_jadwal_tinjauan_manajemen')
    ->name('qa.agendadan_jadwal_tinjauan_manajemen.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
        Route::post('/store', 'store')->name('store');
    });
Route::controller(DaftarhadirTinjuanManajemenController::class)
    ->prefix('qa/tinjauan_manajemen/daftar_hadir_tinjauan_manajemen')
    ->name('qa.daftar_hadir_tinjauan_manajemen.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(NotulenTinjauanManajemenController::class)
    ->prefix('qa/tinjauan_manajemen/notulen_tinjauan_manajemen')
    ->name('qa.notulen_tinjauan_manajemen.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
        Route::get('/export', 'export')->name('export');
        Route::post('/import', 'import')->name('import');
    });
Route::controller(TraceabilityController::class)
    ->prefix('qa/mampu_telusur/traceability')
    ->name('qa.traceability.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(JadwalVerifikasiController::class)
    ->prefix('qa/verifikasi/jadwal_verifikasi')
    ->name('qa.jadwal_verifikasi.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(LaporanPelaksanaanEksporController::class)
    ->prefix('qc/laporan_pelaksanaan_ekspor')
    ->name('qc.laporan_pelaksanaan_ekspor.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(LaporanPenggunaanInstalasiKarantinaHewan::class)
    ->prefix('qc/laporan_penggunaan_instalasi_karantina_hewan')
    ->name('qc.laporan_penggunaan_instalasi_karantina_hewan.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
        Route::post('/import', 'import')->name('import');
    });
Route::controller(PengecekanWaktuPencucianTerakhir::class)
    ->prefix('qc/pengecekan_waktu_pencucian_terakhir')
    ->name('qc.pengecekan_waktu_pencucian_terakhir.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(ProdukReleaseController::class)
    ->prefix('qc/produk_release')
    ->name('qc.produk_release.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(PerencanaanSwabController::class)
    ->prefix('qc/perencanaan_swab')
    ->name('qc.perencanaan_swab.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(ReleaseSteamingController::class)
    ->prefix('qc/release_steaming')
    ->name('qc.release_steaming.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/strore', 'store')->name('store');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(ReleaseCuciTerakhir::class)
    ->prefix('qc/release_cuci_terakhir')
    ->name('qc.release_cuci_terakhir.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/strore', 'store')->name('store');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(MonitoringMuatProdukJadi::class)
    ->prefix('qc/monitoring_muat_produkJadi')
    ->name('qc.monitoring_muat_produkJadi.')
    ->group(function () {
        Route::get('/', 'index')->name('index');

        Route::get('/print', 'print')->name('print');
    });
Route::controller(KontrolPengemasanController::class)
    ->prefix('qc/kontrol_pengemasan')
    ->name('qc.kontrol_pengemasan.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(KontrolGrading::class)
    ->prefix('qc/kontrol_grading')
    ->name('qc.kontrol_grading.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(RecallProdukController::class)
    ->prefix('qa/penarikan_produk')
    ->name('qa.penarikan_produk.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(PemeriksaanRetail::class)
    ->prefix('qc/pemeriksaanretail')
    ->name('qc.pemeriksaanretail.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
        Route::post('/store', 'store')->name('store');
    });

Route::controller(PUR2SeleksiSupplier::class)
    ->prefix('pur/seleksi/seleksisupplier')
    ->name('pur.seleksi.2.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });

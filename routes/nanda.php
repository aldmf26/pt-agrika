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
use App\Http\Controllers\Hrga\Hrga9ProgramKalibrasi\Hrga2JadwalKalibrasiVerfikasi;
use App\Http\Controllers\Hrga\Hrga9ProgramKalibrasi\Hrga1ProgramKalibrasi;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::controller(Hrga5JadwalGapAnalysis::class)
    ->prefix('hrga/2/5-Jadwal-Gap-Analysis')
    ->name('hrga2.5.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/print', 'print')->name('print');
    });

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

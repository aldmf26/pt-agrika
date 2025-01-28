<?php

use App\Http\Controllers\Hrga\Hrga10PenerimaanTamu\Hrga1Visitor;
use App\Http\Controllers\Hrga\Hrga10PenerimaanTamu\Hrga1VisitorHealthForm;
use App\Http\Controllers\Hrga\Hrga10PenerimaanTamu\Hrga2RegistrasiTamu;
use App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru\Hrga1PermohonanKaryawanController;
use App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru\Hrga2HasilWawancara;
use App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru\Hrga3HasilEvaluasiKaryawanBaru;
use App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru\Hrga4DataPegawai;
use App\Http\Controllers\Hrga\Hrga6Sanitasi\Hrga1PerencanaanKebersihan;
use App\Http\Controllers\Hrga\Hrga6Sanitasi\Hrga2CeklistSanitasi;
use App\Http\Controllers\Hrga\Hrga6Sanitasi\Hrga4CeklistFoothbath;
use App\Http\Controllers\Hrga\Hrga7PengelolaanLimbah\Hrga1SchedulePembuanganSampah;
use App\Http\Controllers\Hrga\Hrga7PengelolaanLimbah\Hrga2SchedulePembuanganTps;
use App\Http\Controllers\Hrga\Hrga7PengelolaanLimbah\Hrga3IdentifikasiLimbah;
use App\Http\Controllers\Hrga\Hrga8PerawatanDanPerbaikanMesin\Hrga4CeklistSuhuAc;
use App\Http\Controllers\Hrga\Hrga8PerawatanDanPerbaikanMesin\Hrga6CeklistSuhuColdStorage;
use App\Http\Controllers\Hrga\Hrga8PerawatanDanPerbaikanMesin\Hrga7ceklistPengecekanAir;
use Illuminate\Support\Facades\Route;

// Route::group(['middleware' => ['role:presiden']], function () {
//     Route::controller(UserController::class)
//         ->prefix('user')
//         ->name('user.')
//         ->group(function () {
//             Route::get('/', 'index')->name('index');
//             Route::get('/absen', 'absen')->name('absen');
//             Route::post('/update', 'update')->name('update');
//         });
//     Route::controller(RolePermissionController::class)
//         ->prefix('role')
//         ->name('role.')
//         ->group(function () {
//             Route::get('/', 'index')->name('index');
//             Route::post('/', 'store')->name('store');
//             Route::post('/update', 'update')->name('update');
//             Route::get('/destroy/{id}', 'destroy')->name('destroy');
//         });
// });

Route::controller(Hrga1Visitor::class)
    ->prefix('hrga/hrga10/hrga1-visitor')
    ->name('hrga10.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
    });

Route::controller(Hrga1PermohonanKaryawanController::class)
    ->prefix('hrga/1/1-permohonan-karyawan-baru')
    ->name('hrga1.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print/{id}', 'print')->name('print');
    });

Route::controller(Hrga2HasilWawancara::class)
    ->prefix('hrga/1/2-hasil-wawancara')
    ->name('hrga1.2.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });

Route::controller(Hrga3HasilEvaluasiKaryawanBaru::class)
    ->prefix('hrga/1/3-hasil-evaluasi-karyawan-baru')
    ->name('hrga1.3.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });

Route::controller(Hrga4DataPegawai::class)
    ->prefix('hrga/1/4-data-pegawai')
    ->name('hrga1.4.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });

Route::controller(Hrga1VisitorHealthForm::class)
    ->prefix('hrga/10/1-visitor-health-monitoring-form')
    ->name('hrga10.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });

Route::controller(Hrga2RegistrasiTamu::class)
    ->prefix('hrga/10/2-registrasi-tamu')
    ->name('hrga10.2.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/add', 'add')->name('add');
        Route::post('/add', 'store')->name('store');
        Route::get('/print', 'print')->name('print');
    });

Route::controller(Hrga1PerencanaanKebersihan::class)
    ->prefix('hrga/6/1-perencanaan-kebersihan')
    ->name('hrga6.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/print', 'print')->name('print');
    });

Route::controller(Hrga2CeklistSanitasi::class)
    ->prefix('hrga/6/2-ceklist-sanitasi')
    ->name('hrga6.2.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
            Route::get('/create/', 'create')->name('create');
            Route::get('/add/', 'add')->name('add');
            Route::get('/print', 'print')->name('print');
    });

Route::controller(Hrga4CeklistFoothbath::class)
    ->prefix('hrga/6/4-ceklist-foothbath')
    ->name('hrga6.4.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::get('/print', 'print')->name('print');
    });

Route::controller(Hrga1SchedulePembuanganSampah::class)
    ->prefix('hrga/7/1-schedule-pembuangan-sampah')
    ->name('hrga7.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::get('/print', 'print')->name('print');
    });

Route::controller(Hrga2SchedulePembuanganTps::class)
    ->prefix('hrga/7/2-schedule-pembuangan-tps')
    ->name('hrga7.2.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::get('/print', 'print')->name('print');
    });

Route::controller(Hrga3IdentifikasiLimbah::class)
    ->prefix('hrga/7/3-identifikasi-limbah')
    ->name('hrga7.3.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::get('/print', 'print')->name('print');
    });

Route::controller(Hrga4CeklistSuhuAc::class)
    ->prefix('hrga/8/4-ceklist-suhu-ac')
    ->name('hrga8.4.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(Hrga6CeklistSuhuColdStorage::class)
    ->prefix('hrga/8/6-ceklist-suhu-cold-storage')
    ->name('hrga8.6.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::get('/print', 'print')->name('print');
    });
Route::controller(Hrga7ceklistPengecekanAir::class)
    ->prefix('hrga/8/7-ceklist-pengecekan-air')
    ->name('hrga8.7.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::get('/print', 'print')->name('print');
    });

    

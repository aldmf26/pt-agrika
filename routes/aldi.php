<?php

use App\Http\Controllers\Hrga\Hrga10PenerimaanTamu\Hrga1Visitor;
use App\Http\Controllers\Hrga\Hrga10PenerimaanTamu\Hrga1VisitorHealthForm;
use App\Http\Controllers\Hrga\Hrga10PenerimaanTamu\Hrga2RegistrasiTamu;
use App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru\Hrga1PermohonanKaryawanController;
use App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru\Hrga2HasilWawancara;
use App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru\Hrga3HasilEvaluasiKaryawanBaru;
use App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru\Hrga4DataPegawai;
use App\Http\Controllers\Hrga\Hrga7PengelolaanLimbah\Hrga1SchedulePembuanganSampah;
use App\Http\Controllers\Hrga\Hrga8PerawatanDanPerbaikanMesin\Hrga4CeklistSuhuAc;
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

Route::controller(Hrga1SchedulePembuanganSampah::class)
    ->prefix('hrga/7/1-schedule-pembuangan-sampah')
    ->name('hrga7.1.')
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

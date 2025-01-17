<?php

use App\Http\Controllers\Hrga\Hrga10PenerimaanTamu\Hrga1Visitor;
use App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru\Hrga4DataPegawai;
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

Route::controller(Hrga4DataPegawai::class)
    ->prefix('hrga/1/1-permohonan-karyawan-baru')
    ->name('hrga1.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
    });

Route::controller(Hrga4DataPegawai::class)
    ->prefix('hrga/1/4-data-pegawai')
    ->name('hrga1.4.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
    });

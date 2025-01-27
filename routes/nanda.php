<?php

use App\Http\Controllers\Hrga\Hrga5PerbaikandanPerawatanSaranaPrasarana\Hrga1ProgramPerawatanSaranadanPrasaranaUmum;
use App\Http\Controllers\Hrga\Hrga9ProgramKalibrasi\Hrga2JadwalKalibrasiVerfikasi;
use App\Http\Controllers\Hrga\Hrga9ProgramKalibrasi\Hrga1ProgramKalibrasi;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


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

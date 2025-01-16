<?php

use App\Http\Controllers\Hrga9_01ProgramKalibrasi;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::controller(Hrga9_01ProgramKalibrasi::class)
    ->prefix('hrga/hrga9')
    ->name('hrga9.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
    });

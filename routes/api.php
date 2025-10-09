<?php

use App\Http\Controllers\Api\GradeSbwCOntroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::controller(GradeSbwCOntroller::class)
    ->prefix('apikodesbw')
    ->name('apikodesbw.')
    ->group(function () {
        Route::get('/grade_sbw', 'grade_sbw')->name('grade_sbw');
        Route::get('/detail_grade_sbw', 'detail_grade_sbw')->name('detail_grade_sbw');
        Route::get('/rumah_walet', 'rumah_walet')->name('rumah_walet');
        Route::get('/detail_rumah_walet', 'detail_rumah_walet')->name('detail_rumah_walet');
    });

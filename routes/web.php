<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Hrga\Hrga10PenerimaanTamu\Hrga1VisitorHealthForm;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tidak', function () {
    $data = [
        'title' => 'tidak'
    ];
    return view('tidak', $data);
})->name('tidak');

Route::get('/tamu', [Hrga1VisitorHealthForm::class, 'tamu']);
Route::post('/tamu', [Hrga1VisitorHealthForm::class, 'storeTamu'])->name('tamu.store');

Route::controller(DashboardController::class)
    ->prefix('dashboard')
    ->name('dashboard.')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/{title}', 'detail')->name('detail');
        Route::get('/sub/{title}', 'sub')->name('sub');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/aldi.php';
require __DIR__ . '/nanda.php';

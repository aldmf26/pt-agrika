<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Hrga\Hrga10PenerimaanTamu\Hrga1VisitorHealthForm;
use App\Http\Controllers\Hrga\Hrga5PerbaikandanPerawatanSaranaPrasarana\Hrga3PermintaanPerbaikan;
use App\Http\Controllers\Hrga\Hrga8PerawatanDanPerbaikanMesin\Hrga3PermintaanPerbaikanMesin;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionerController;
use App\Models\DataPegawai;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tes', function () {
    return view('tes');
});

Route::get('/tidak', function () {
    $data = [
        'title' => 'tidak'
    ];
    return view('tidak', $data);
})->name('tidak');

Route::get('/verify-ttd/{id_pegawai}', function ($id_pegawai) {
    $pegawai = DataPegawai::where('karyawan_id_dari_api', $id_pegawai)->first();

    $data = [
        'pegawai' => $pegawai
    ];
    return view('verify_ttd', $data);
})->name('verify-ttd');

Route::get('/questioner', [QuestionerController::class, 'questioner']);
Route::post('/questioner', [QuestionerController::class, 'questioner_store'])->name('questioner.store');
Route::get('/tamu', [Hrga1VisitorHealthForm::class, 'tamu']);
Route::post('/tamu', [Hrga1VisitorHealthForm::class, 'storeTamu'])->name('tamu.store');

Route::get('/formPermintaanperbaikan', [Hrga3PermintaanPerbaikan::class, 'formPermintaanperbaikan'])
    ->name('formPermintaanperbaikan');

Route::get('/formpengajuan', [Hrga3PermintaanPerbaikanMesin::class, 'formpengajuan'])
    ->name('formpengajuan');


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

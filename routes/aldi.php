<?php

use App\Http\Controllers\Hrga\Hrga10PenerimaanTamu\Hrga1VisitorHealthForm;
use App\Http\Controllers\Hrga\Hrga10PenerimaanTamu\Hrga2RegistrasiTamu;
use App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru\Hrga1PermohonanKaryawanController;
use App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru\Hrga2HasilWawancara;
use App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru\Hrga3HasilEvaluasiKaryawanBaru;
use App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru\Hrga4DataPegawai;
use App\Http\Controllers\Hrga\Hrga2PenilaianKompetensi\Hrga2PenilaianKompetensi;
use App\Http\Controllers\Hrga\Hrga6Sanitasi\Hrga1PerencanaanKebersihan;
use App\Http\Controllers\Hrga\Hrga6Sanitasi\Hrga2CeklistSanitasi;
use App\Http\Controllers\Hrga\Hrga6Sanitasi\Hrga4CeklistFoothbath;
use App\Http\Controllers\Hrga\Hrga7PengelolaanLimbah\Hrga1SchedulePembuanganSampah;
use App\Http\Controllers\Hrga\Hrga7PengelolaanLimbah\Hrga2SchedulePembuanganTps;
use App\Http\Controllers\Hrga\Hrga7PengelolaanLimbah\Hrga3IdentifikasiLimbah;
use App\Http\Controllers\Hrga\Hrga8PerawatanDanPerbaikanMesin\Hrga4CeklistSuhuAc;
use App\Http\Controllers\Hrga\Hrga8PerawatanDanPerbaikanMesin\Hrga6CeklistSuhuColdStorage;
use App\Http\Controllers\Hrga\Hrga8PerawatanDanPerbaikanMesin\Hrga7ceklistPengecekanAir;
use App\Http\Controllers\IA\IA1ProgramAuditInternalController;
use App\Http\Controllers\IA\IA2JadwalAuditInternalController;
use App\Http\Controllers\IA\IA4LaporanAuditInternalController;
use App\Http\Controllers\PPC\Gudang_FG\FG1DeliveryOrderController;
use App\Http\Controllers\PPC\Gudang_FG\FG2CeklisKendaraanController;
use App\Http\Controllers\PPC\Gudang_FG\FG3BuktiPenerimaanBarangController;
use App\Http\Controllers\PPC\Gudang_FG\FG4KartuStokController;
use App\Http\Controllers\PPC\Gudang_RM\RM10KodeProdukJadiController;
use App\Http\Controllers\PPC\Gudang_RM\RM1PenerimaanBarangController;
use App\Http\Controllers\PPC\Gudang_RM\RM2PenerimaanKemasanController;
use App\Http\Controllers\PPC\Gudang_RM\RM3PenerimaanSBWKotorController;
use App\Http\Controllers\PPC\Gudang_RM\RM4SkPengirimanSbwKotorController;
use App\Http\Controllers\PPC\Gudang_RM\RM5LabelIdentitasBahanController;
use App\Http\Controllers\PPC\Gudang_RM\RM6CeklistKendaraanController;
use App\Http\Controllers\PPC\Gudang_RM\RM7BuktiPermintaanPengeluaranBarangController;
use App\Http\Controllers\PPC\Gudang_RM\RM8KartuStokController;
use App\Http\Controllers\PPC\Gudang_RM\RM9KodeBahanBakuKimiaController;
use App\Http\Controllers\PUR\Evaluasi\PUR1EvaluasiSupplierController;
use App\Http\Controllers\PUR\Pembelian\PUR1PurchaseRequestController;
use App\Http\Controllers\PUR\Pembelian\PUR2PurchaseOrderController;
use App\Http\Controllers\PUR\SeleksiSupplier\PUR1DaftarSupplierController;
use App\Http\Controllers\QA\PenangananBarangTakSesuai\QA1PenangananProdukController;
use App\Http\Controllers\QA\PenangananBarangTakSesuai\QA2BeritaAcaraPemusnahanProdukController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::controller(UserController::class)
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::post('/upload', 'upload')->name('upload');
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

Route::controller(Hrga2PenilaianKompetensi::class)
    ->prefix('hrga/2/2-penilaian-kompetensi')
    ->name('hrga2.2.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/penilaian/{id}', 'penilaian')->name('penilaian');
        Route::get('/print/{id}', 'print')->name('print');
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
        Route::get('/add/', 'add')->name('add');
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

Route::controller(IA1ProgramAuditInternalController::class)
    ->prefix('ia/1-program-audit-internal')
    ->name('ia.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::get('/print', 'print')->name('print');
        Route::get('/audit', 'audit')->name('audit');
    });
Route::controller(IA2JadwalAuditInternalController::class)
    ->prefix('ia/2-jadwal-audit-internal')
    ->name('ia.2.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create/', 'store')->name('store');
        Route::get('/edit/{tgl}', 'edit')->name('edit');
        Route::get('/print/{tgl}', 'print')->name('print');
    });

Route::controller(IA4LaporanAuditInternalController::class)
    ->prefix('ia/4-laporan-audit-internal')
    ->name('ia.4.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create/', 'store')->name('store');
        Route::get('/edit', 'edit')->name('edit');
        Route::get('/print', 'print')->name('print');
    });

Route::controller(RM1PenerimaanBarangController::class)
    ->prefix('ppc/gudang-rm/1-penerimaan-barang')
    ->name('ppc.gudang-rm.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print/{tgl}', 'print')->name('print');
    });

Route::controller(RM2PenerimaanKemasanController::class)
    ->prefix('ppc/gudang-rm/2-penerimaan-kemasan')
    ->name('ppc.gudang-rm.2.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print/{tgl}', 'print')->name('print');
    });

Route::controller(RM3PenerimaanSBWKotorController::class)
    ->prefix('ppc/gudang-rm/3-penerimaan-kemasan-sbw-kotor')
    ->name('ppc.gudang-rm.3.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print/{tgl}', 'print')->name('print');
    });

Route::controller(RM4SkPengirimanSbwKotorController::class)
    ->prefix('ppc/gudang-rm/4-sk-pengiriman-sbw-kotor')
    ->name('ppc.gudang-rm.4.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print/{tgl}', 'print')->name('print');
    });

Route::controller(RM5LabelIdentitasBahanController::class)
    ->prefix('ppc/gudang-rm/5-label-identitas-bahan')
    ->name('ppc.gudang-rm.5.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print/', 'print')->name('print');
    });

Route::controller(RM6CeklistKendaraanController::class)
    ->prefix('ppc/gudang-rm/6-ceklis-kendaraan')
    ->name('ppc.gudang-rm.6.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print/{tgl}', 'print')->name('print');
    });


Route::controller(RM7BuktiPermintaanPengeluaranBarangController::class)
    ->prefix('ppc/gudang-rm/7-bukti-permintaan-pengeluaran-barang')
    ->name('ppc.gudang-rm.7.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print/', 'print')->name('print');
    });

Route::controller(RM8KartuStokController::class)
    ->prefix('ppc/gudang-rm/8-kartu-stok')
    ->name('ppc.gudang-rm.8.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print/', 'print')->name('print');
    });

Route::controller(RM9KodeBahanBakuKimiaController::class)
    ->prefix('ppc/gudang-rm/9-kode-bahan-baku-dan-kimia')
    ->name('ppc.gudang-rm.9.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print/', 'print')->name('print');
    });

Route::controller(RM10KodeProdukJadiController::class)
    ->prefix('ppc/gudang-rm/10-kode-produk-jadi')
    ->name('ppc.gudang-rm.10.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print/', 'print')->name('print');
    });

Route::controller(FG1DeliveryOrderController::class)
    ->prefix('ppc/gudang-fg/1-delivery-order')
    ->name('ppc.gudang-fg.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print/{no_order}', 'print')->name('print');
    });

Route::controller(FG2CeklisKendaraanController::class)
    ->prefix('ppc/gudang-fg/2-ceklis-kendaraan')
    ->name('ppc.gudang-fg.2.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print/{tgl}', 'print')->name('print');
    });

Route::controller(FG3BuktiPenerimaanBarangController::class)
    ->prefix('ppc/gudang-fg/3-bukti-penerimaan-barang')
    ->name('ppc.gudang-fg.3.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print/{tgl}', 'print')->name('print');
    });

Route::controller(FG4KartuStokController::class)
    ->prefix('ppc/gudang-fg/4-kartu-stok')
    ->name('ppc.gudang-fg.4.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print/{tgl}', 'print')->name('print');
    });

Route::controller(PUR1PurchaseRequestController::class)
    ->prefix('pur/pembelian/purchase-request')
    ->name('pur.pembelian.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/selesai/{id}', 'selesai')->name('selesai');
        Route::get('/print/{tgl}', 'print')->name('print');
    });

Route::controller(PUR2PurchaseOrderController::class)
    ->prefix('pur/pembelian/purchase-order')
    ->name('pur.pembelian.2.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'selesai')->name('selesai');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print/{tgl}', 'print')->name('print');
    });

Route::controller(PUR1DaftarSupplierController::class)
    ->prefix('pur/seleksi/supplier')
    ->name('pur.seleksi.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print', 'print')->name('print');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::get('/evaluasi/{id}', 'evaluasi')->name('evaluasi');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
    });

Route::controller(PUR1EvaluasiSupplierController::class)
    ->prefix('pur/evaluasi/supplier')
    ->name('pur.evaluasi.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print', 'print')->name('print');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
    });

Route::controller(QA1PenangananProdukController::class)
    ->prefix('qa/penanganan-barang-tidak-sesuai/penanganan-produk')
    ->name('qa.penanganan-produk.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print/{id}', 'print')->name('print');
    });

Route::controller(QA2BeritaAcaraPemusnahanProdukController::class)
    ->prefix('qa/penanganan-barang-tidak-sesuai/berita-acara-pemusnahan-produk')
    ->name('qa.penanganan-produk.2.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print', 'print')->name('print');
    });

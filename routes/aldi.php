<?php

use App\Http\Controllers\Hrga\Hrga10PenerimaanTamu\Hrga1VisitorHealthForm;
use App\Http\Controllers\Hrga\Hrga10PenerimaanTamu\Hrga2RegistrasiTamu;
use App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru\Hrga1PermohonanKaryawanController;
use App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru\Hrga2HasilWawancara;
use App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru\Hrga3HasilEvaluasiKaryawanBaru;
use App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru\Hrga4DataPegawai;
use App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru\Hrga5JobDeskController;
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
use App\Http\Controllers\QA\CAPA\TindakanPerbaikanDanPencegahanController;
use App\Http\Controllers\QA\PenangananBarangTakSesuai\QA1PenangananProdukController;
use App\Http\Controllers\QA\PenangananBarangTakSesuai\QA2BeritaAcaraPemusnahanProdukController;
use App\Http\Controllers\QA\Recall\HasilAnalisaProsesRecallController;
use App\Http\Controllers\QA\Recall\InformasiRecallProdukController;
use App\Http\Controllers\QuestionerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::controller(UserController::class)
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::post('/upload', 'upload')->name('upload');
        Route::post('/store', 'store')->name('store');
    });

Route::controller(Hrga1PermohonanKaryawanController::class)
    ->prefix('hrga/1/1-permohonan-karyawan-baru')
    ->name('hrga1.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/singkron', 'singkron')->name('singkron');
        Route::post('/store', 'store')->name('store');
        Route::get('/print/{permohonan}', 'print')->name('print');
        Route::get('/edit/{permohonan}', 'edit')->name('edit');
        Route::get('/destroy/{permohonan}', 'destroy')->name('destroy');
        Route::post('/update/{permohonan}', 'update')->name('update');
    });

Route::controller(Hrga2HasilWawancara::class)
    ->prefix('hrga/1/2-hasil-wawancara')
    ->name('hrga1.2.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/edit/{pegawai}', 'edit')->name('edit');
        Route::post('/update/{pegawai}', 'update')->name('update');
        Route::get('/print/{pegawai}', 'print')->name('print');
        Route::get('/edit/{pegawai}', 'edit')->name('edit');
        Route::get('/singkron', 'singkron')->name('singkron');
    });

Route::controller(QuestionerController::class)
    ->prefix('qa/questioner')
    ->name('qa.questioner.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/update', 'update')->name('update');
    });

Route::controller(Hrga3HasilEvaluasiKaryawanBaru::class)
    ->prefix('hrga/1/3-hasil-evaluasi-karyawan-baru')
    ->name('hrga1.3.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print/{pegawai}', 'print')->name('print');
    });

Route::controller(Hrga4DataPegawai::class)
    ->prefix('hrga/1/4-data-pegawai')
    ->name('hrga1.4.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });

Route::controller(Hrga5JobDeskController::class)
    ->prefix('hrga/1/5-job-description')
    ->name('hrga1.5.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/print', 'print')->name('print');
    });

Route::controller(Hrga5JobDeskController::class)
    ->prefix('hrga/1/6-struktur')
    ->name('hrga1.6.')
    ->group(function () {
        Route::get('/', 'struktur')->name('struktur');
        Route::get('/print', 'print')->name('print');
    });

Route::controller(Hrga2PenilaianKompetensi::class)
    ->prefix('hrga/2/2-penilaian-kompetensi')
    ->name('hrga2.2.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/absen', 'absen')->name('absen');
        Route::get('/singkron', 'singkron')->name('singkron');
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
        Route::post('/update', 'update')->name('update');
        Route::get('/print', 'print')->name('print');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy');
    });

Route::controller(Hrga2CeklistSanitasi::class)
    ->prefix('hrga/6/ceklist-sanitasi')
    ->name('hrga6.2.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::get('/add/', 'add')->name('add');
        Route::get('/print', 'print')->name('print');
        Route::get('/getItems', 'getItems')->name('getItems');
        Route::post('/update', 'update')->name('update');
        Route::post('/store', 'store')->name('store');
    });

Route::controller(Hrga4CeklistFoothbath::class)
    ->prefix('hrga/6/3-ceklist-foothbath')
    ->name('hrga6.4.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::get('/add/', 'add')->name('add');
        Route::get('/print', 'print')->name('print');
        Route::get('/get/{id}', 'get')->name('get');
        Route::post('/update', 'update')->name('update');
        Route::post('/store', 'store')->name('store');
    });

Route::controller(Hrga1SchedulePembuanganSampah::class)
    ->prefix('hrga/7/1-schedule-pembuangan-sampah')
    ->name('hrga7.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/store/', 'store')->name('store');
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
        Route::get('/print_audit_departemen', 'print_audit_departemen')->name('print_audit_departemen');
    });
Route::controller(IA2JadwalAuditInternalController::class)
    ->prefix('ia/2-jadwal-audit-internal')
    ->name('ia.2.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create/', 'store')->name('store');
        Route::get('/edit/{tgl}', 'edit')->name('edit');
        Route::post('/edit/{tgl}', 'update')->name('update');
        Route::get('/print/{tgl}', 'print')->name('print');
        Route::get('/destroy/{tgl}', 'destroy')->name('destroy');
    });

Route::controller(IA4LaporanAuditInternalController::class)
    ->prefix('ia/4-summary-logsheet-finding-audit-internal')
    ->name('ia.4.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create/', 'store')->name('store');
        Route::get('/edit/{laporan}', 'edit')->name('edit');
        Route::post('/update/{laporan}', 'update')->name('update');
        Route::get('/print', 'print')->name('print');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
    });

Route::controller(RM1PenerimaanBarangController::class)
    ->prefix('ppc/gudang-rm/1-penerimaan-barang')
    ->name('ppc.gudang-rm.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print/{tgl}', 'print')->name('print');
        Route::get('/delete/', 'delete')->name('delete');
    });

Route::controller(RM2PenerimaanKemasanController::class)
    ->prefix('ppc/gudang-rm/2-penerimaan-kemasan')
    ->name('ppc.gudang-rm.2.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print/{tgl}', 'print')->name('print');
        Route::get('/delete/', 'delete')->name('delete');
    });

Route::controller(RM3PenerimaanSBWKotorController::class)
    ->prefix('ppc/gudang-rm/3-penerimaan-kemasan-sbw-kotor')
    ->name('ppc.gudang-rm.3.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print', 'print')->name('print');
    });

Route::controller(RM4SkPengirimanSbwKotorController::class)
    ->prefix('ppc/gudang-rm/4-sk-pengiriman-sbw-kotor')
    ->name('ppc.gudang-rm.4.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print/{id}', 'print')->name('print');
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
        Route::get('/print', 'print')->name('print');
    });


Route::controller(RM7BuktiPermintaanPengeluaranBarangController::class)
    ->prefix('ppc/gudang-rm/7-bukti-permintaan-pengeluaran-barang')
    ->name('ppc.gudang-rm.7.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print/', 'print')->name('print');
        Route::get('/destroy/', 'destroy')->name('destroy');
    });

Route::controller(RM8KartuStokController::class)
    ->prefix('ppc/gudang-rm/8-kartu-stok')
    ->name('ppc.gudang-rm.8.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print/', 'print')->name('print');
        Route::get('/lacak/', 'lacak')->name('lacak');
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
        Route::get('/print', 'print')->name('print');
    });

Route::controller(FG2CeklisKendaraanController::class)
    ->prefix('ppc/gudang-fg/2-ceklis-kendaraan')
    ->name('ppc.gudang-fg.2.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print', 'print')->name('print');
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
        Route::get('/print', 'print')->name('print');
    });

Route::controller(PUR1PurchaseRequestController::class)
    ->prefix('pur/pembelian/purchase-request')
    ->name('pur.pembelian.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/selesai/{id}/{kategori}', 'selesai')->name('selesai');
        Route::get('/destroy/{id}/{kategori}', 'destroy')->name('destroy');
        Route::get('/print/{tgl}', 'print')->name('print');
        Route::get('/print_sbw/', 'print_sbw')->name('print_sbw');
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
        Route::get('/print_sbw/', 'print_sbw')->name('print_sbw');
        Route::get('/destroy/{id}/{kategori}', 'destroy')->name('destroy');
    });

Route::controller(PUR1DaftarSupplierController::class)
    ->prefix('pur/seleksi/supplier')
    ->name('pur.seleksi.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print', 'print')->name('print');
        Route::get('/edit/{id}/{kategori}', 'edit')->name('edit');

        Route::get('/evaluasi/', 'evaluasi')->name('evaluasi');
        Route::get('/evaluasi_sbw/', 'evaluasi_sbw')->name('evaluasi_sbw');

        Route::get('/seleksi/{supplier}', 'seleksi')->name('seleksi');
        Route::get('/seleksi_sbw/{supplier}', 'seleksi_sbw')->name('seleksi_sbw');

        Route::get('/create_seleksi/{supplier}', 'create_seleksi')->name('create_seleksi');
        Route::post('/create_seleksi/{supplier}', 'store_seleksi')->name('store_seleksi');

        Route::get('/create_seleksi_sbw/{supplier}', 'create_seleksi_sbw')->name('create_seleksi_sbw');
        Route::post('/create_seleksi_sbw/{supplier}', 'store_seleksi_sbw')->name('store_seleksi_sbw');

        Route::get('/evaluasi_print_sbw/', 'evaluasi_print_sbw')->name('evaluasi_print_sbw');
        Route::post('/evaluasi/', 'evaluasi_update')->name('evaluasi_update');

        Route::post('/evaluasi_sbw/', 'evaluasi_sbw_update')->name('evaluasi_sbw_update');
        Route::get('/print-evaluasi/', 'evaluasi_print')->name('evaluasi_print');

        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
    });

Route::controller(PUR1EvaluasiSupplierController::class)
    ->prefix('pur/evaluasi/supplier')
    ->name('pur.evaluasi.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print', 'print')->name('print');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
    });

Route::middleware(['auth'])->group(function () {
    Route::controller(TindakanPerbaikanDanPencegahanController::class)
        ->prefix('qa/capa/tindakan-perbaikan-dan-pencegahan')
        ->name('qa.capa.1.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/destroy/{id}', 'destroy')->name('destroy');
            Route::post('/bulk-destroy', 'bulkDestroy')->name('bulkDestroy');
            Route::get('/download/{id}', 'download')->name('download');
            Route::get('/get-folders-files', 'getFoldersAndFiles')->name('getFoldersAndFiles');
            Route::post('/create-folder', 'createFolder')->name('createFolder');
            Route::post('/update-folder', 'updateFolder')->name('updateFolder');
            Route::post('/delete-folder', 'deleteFolder')->name('deleteFolder');
        });
});

Route::controller(QA1PenangananProdukController::class)
    ->prefix('qa/penanganan-barang-tidak-sesuai/penanganan-produk')
    ->name('qa.penanganan-produk.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/create', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::get('/print/{id}', 'print')->name('print');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
    });

Route::controller(InformasiRecallProdukController::class)
    ->prefix('qa/informasi-recall-produk')
    ->name('qa.5.1.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/print/{id}', 'print')->name('print');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/edit/{id}', 'update')->name('update');
        Route::get('/hasil/{id}', 'hasil')->name('hasil');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
        Route::post('/hasil/{id}', 'store_hasil')->name('store_hasil');
        Route::get('/hasil_print/{id}', 'hasil_print')->name('hasil_print');
    });

Route::controller(HasilAnalisaProsesRecallController::class)
    ->prefix('qa/hasil-analisa-proses-recall')
    ->name('qa.5.2.')
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
        Route::post('/edit', 'edit')->name('edit');
        Route::get('/print', 'print')->name('print');
    });

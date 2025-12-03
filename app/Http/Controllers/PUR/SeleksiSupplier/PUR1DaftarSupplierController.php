<?php

namespace App\Http\Controllers\PUR\SeleksiSupplier;

use App\Http\Controllers\Controller;
use App\Models\DetailKetidaksesuaian;
use App\Models\Evaluasi;
use App\Models\PurchaseOrder;
use App\Models\RumahWalet;
use App\Models\SeleksiSupplier;
use App\Models\Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PUR1DaftarSupplierController extends Controller
{
    public function index(Request $r)
    {
        $kategori = $r->kategori ?? 'barang';
        $datas = Suplier::where('kategori', $kategori)->latest()->get();

        $data = [
            'title' => 'PUR 1 Daftar Supplier',
            'datas' => $datas,
            'rumah_walet' => RumahWalet::orderByDesc('id')->get(),
            'kategori' => $kategori,
        ];

        return view('pur.seleksi.daftar_supplier.index', $data);
    }

    public function seleksi(Suplier $supplier)
    {
        $kode = [
            'lainnya' => 'PURS.01.04',
            'barang' => 'PURB.01.04',
            'kemasan' => 'PURK.01.04',
            'jasa' => 'PURJ.01.02',
        ];
        $nomor = $kode[strtolower($supplier->kategori)] ?? 'PURS.01.04';
        $data = [
            'title' => 'Seleksi Supplier',
            'supplier' => $supplier,
            'kategori' => $supplier->kategori,
            'dok' => "Dok.No.: FRM.{$nomor}, Rev.00",
        ];
        return view('pur.seleksi.daftar_supplier.seleksi', $data);
    }

    public function create_seleksi_sbw(RumahWalet $supplier)
    {
        $seleksi = $supplier->seleksi()->latest()->first();
        $data = [
            'title' => 'Tambah Seleksi Supplier',
            'supplier' => $supplier,
            'seleksi' => $seleksi,
        ];
        return view('pur.seleksi.daftar_supplier.create_seleksi_sbw', $data);
    }

    public function create_seleksi(Suplier $supplier)
    {
        $seleksi = $supplier->seleksi()->latest()->first();
        $data = [
            'title' => 'Tambah Seleksi Supplier',
            'supplier' => $supplier,
            'seleksi' => $seleksi,
        ];
        return view('pur.seleksi.daftar_supplier.create_seleksi', $data);
    }

    public function store_seleksi_sbw(RumahWalet $supplier, Request $r)
    {

        try {
            DB::beginTransaction();
            $data = [
                'supplier_id' => $supplier->id,
                'material_ditawarkan' => $r->material_ditawarkan,
                'reg_rwb' => $r->reg_rwb,
                'spesifikasi' => $r->spesifikasi,
                'estimasi_delivery' => $r->estimasi_delivery,
                'sistem_manajemen' => $r->sistem_manajemen,
                'manajemen_lainnya' => $r->manajemen_lainnya ?? null,
                'profil_perusahaan' => $r->profil_perusahaan,
                'jatuh_tempo' => $r->jatuh_tempo,
                'sample' => $r->sample,
                'hasil_pemeriksaan_lab' => $r->hasil_pemeriksaan_lab,
                'lab_kesimpulan' => $r->lab_kesimpulan,
                'hasil_pemeriksaan_penerimaan' => $r->hasil_pemeriksaan_penerimaan,
                'penerimaan_kesimpulan' => $r->penerimaan_kesimpulan,
                'hasil_pemeriksaan_hewan' => $r->hasil_pemeriksaan_hewan,
                'hewan_kesimpulan' => $r->hewan_kesimpulan,
                'admin' => auth()->user()->name,
                'tgl' => date('Y-m-d'),
            ];

            $seleksi = SeleksiSupplier::where('supplier_id', $supplier->id)->first();
            if ($seleksi) {
                $seleksi->update($data);
            } else {
                SeleksiSupplier::create($data);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
        return redirect()->back()->with('sukses', 'Seleksi Supplier berhasil ditambahkan');
    }

    public function store_seleksi(Suplier $supplier, Request $r)
    {

        try {
            DB::beginTransaction();
            $data = [
                'supplier_id' => $supplier->id,
                'material_ditawarkan' => $r->material_ditawarkan,
                'reg_rwb' => $r->reg_rwb,
                'spesifikasi' => $r->spesifikasi,
                'estimasi_delivery' => $r->estimasi_delivery,
                'sistem_manajemen' => $r->sistem_manajemen,
                'manajemen_lainnya' => $r->manajemen_lainnya ?? null,
                'profil_perusahaan' => $r->profil_perusahaan,
                'jatuh_tempo' => $r->jatuh_tempo,
                'sample' => $r->sample,
                'hasil_pemeriksaan_lab' => $r->hasil_pemeriksaan_lab,
                'lab_kesimpulan' => $r->lab_kesimpulan,
                'hasil_pemeriksaan_penerimaan' => $r->hasil_pemeriksaan_penerimaan,
                'penerimaan_kesimpulan' => $r->penerimaan_kesimpulan,
                'hasil_pemeriksaan_hewan' => $r->hasil_pemeriksaan_hewan,
                'hewan_kesimpulan' => $r->hewan_kesimpulan,
                'admin' => auth()->user()->name,
                'tgl' => date('Y-m-d'),
            ];

            $seleksi = SeleksiSupplier::where('supplier_id', $supplier->id)->first();
            if ($seleksi) {
                $seleksi->update($data);
            } else {
                SeleksiSupplier::create($data);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
        return redirect()->back()->with('sukses', 'Seleksi Supplier berhasil ditambahkan');
    }

    public function seleksi_sbw(RumahWalet $supplier)
    {
        $data = [
            'title' => 'Seleksi Supplier',
            'supplier' => $supplier,
            'dok' => 'Dok.No.: FRM.PURS.01.03, Rev.00',
        ];
        return view('pur.seleksi.daftar_supplier.seleksi_sbw', $data);
    }

    public function evaluasi(Request $r)
    {
        $supplier_id = $r->id;
        $semester = $r->semester ?? 1;
        $supplier = Suplier::where('id', $supplier_id)->first();
        $evaluasi = Evaluasi::with(['detail', 'supplier'])->where([['supplier_id', $supplier_id], ['semester', $semester]])->first();
        $detailAda = !empty(optional($evaluasi)->detail);

        $data = [
            'title' => 'Evaluasi Supplier : ',
            'semester' => $semester,
            'supplier' => $supplier,
            'evaluasi' => $evaluasi,
            'detailAda' => $detailAda,
        ];

        return view('pur.seleksi.daftar_supplier.evaluasi', $data);
    }
    public function evaluasi_update(Request $r)
    {
        $id = $r->suplier_id;
        try {
            DB::beginTransaction();
            $evaluasi =  Evaluasi::updateOrCreate(
                [
                    'supplier_id' => $id,
                    'semester' => $r->semester,
                ],
                [
                    'supplier_id' => $id,
                    'semester' => $r->semester,
                    'tgl' => $r->tgl,
                ],
            );
            $evaluasi->detail()->delete();

            $evaluasi->detail()->create([
                'jenis_kriteria' => 'harga',
                'tanggal_ketidaksesuaian' => now(),
                'alasan' => $r->harga_keterangan ?? null,
                'penilaian' => $r->harga_penilaian ?? 0,
            ]);

            $evaluasi->detail()->create([
                'jenis_kriteria' => 'komunikasi',
                'tanggal_ketidaksesuaian' => now(),
                'alasan' => $r->harga_keterangan ?? null,
                'penilaian' => $r->komunikasi_penilaian ?? 0,
            ]);

            $kuantitas = collect($r->kuantitas_tanggal)->map(function ($tanggal, $index) use ($r) {
                return [
                    'jenis_kriteria' => 'kuantitas',
                    'tanggal_ketidaksesuaian' => $tanggal,
                    'alasan' => $r->kuantitas_karena[$index] ?? null,
                    'penilaian' => $r->kuantitas_penilaian[$index] ?? 0,
                ];
            });

            $waktu = collect($r->waktu_tanggal)->map(function ($tanggal, $index) use ($r) {
                return [
                    'jenis_kriteria' => 'waktu',
                    'tanggal_ketidaksesuaian' => $tanggal,
                    'alasan' => $r->waktu_karena[$index] ?? null,
                    'penilaian' => $r->waktu_penilaian[$index] ?? 0,
                ];
            });

            $kualitas = collect($r->kualitas_tanggal)->map(function ($tanggal, $index) use ($r) {
                return [
                    'jenis_kriteria' => 'kualitas',
                    'tanggal_ketidaksesuaian' => $tanggal,
                    'alasan' => $r->kualitas_karena[$index] ?? null,
                    'penilaian' => $r->kualitas_penilaian[$index] ?? 0,
                ];
            });

            $evaluasi->detail()->createMany($kuantitas->merge($waktu)->merge($kualitas)->toArray());

            // 🔹 Hitung total setelah semua detail tersimpan
            $evaluasi->load('detail'); // refresh relasi

            $kuantitas = $evaluasi->detail->where('jenis_kriteria', 'kuantitas')->whereNotNull('alasan');
            $waktu = $evaluasi->detail->where('jenis_kriteria', 'waktu')->whereNotNull('alasan');
            $kualitas = $evaluasi->detail->where('jenis_kriteria', 'kualitas')->whereNotNull('alasan');
            $harga = $evaluasi->detail->where('jenis_kriteria', 'harga')->first();
            $komunikasi = $evaluasi->detail->where('jenis_kriteria', 'komunikasi')->first();

            $totalPenilaian =
                ($kuantitas->avg('penilaian') ?? 100) +
                ($waktu->avg('penilaian') ?? 100) +
                ($kualitas->avg('penilaian') ?? 100) +
                ($harga ? $harga->penilaian : 100) +
                ($komunikasi ? $komunikasi->penilaian : 100);

            $rataRata = $totalPenilaian / 5;

            Suplier::find($id)->update([
                'hasil_evaluasi' => $rataRata,
            ]);

            DB::commit();
            return redirect()->back()->with('sukses', 'Evaluasi Supplier berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function evaluasi_print(Request $r)
    {

        $supplier_id = $r->supplier_id;
        $semester = $r->semester ?? 1;
        $supplier = Suplier::where('id', $supplier_id)->first();
        $evaluasi = Evaluasi::where([['supplier_id', $supplier_id], ['semester', $semester]])->latest()->first();
        $kodes = [
            'lainnya' => 'PURS.01.05',
            'barang' => 'PURB.01.05',
            'kemasan' => 'PURK.01.05',
            'jasa' => 'PURJ.01.03',
        ];

        $nomor = $kodes[strtolower($supplier->kategori)] ?? 'PURS.01.05';

        $data = [
            'title' => 'EVALUASI SUPPLIER',
            'dok' => "Dok.No.: FRM.{$nomor}, Rev.00",
            'evaluasi' => $evaluasi,
            'supplier' => $supplier
        ];
        return view('pur.seleksi.daftar_supplier.print_evaluasi', $data);
    }

    public function evaluasi_sbw(Request $r)
    {
        $id = $r->id;
        $semester = $r->semester ?? 1;
        $rumahWalet = RumahWalet::where('id', $id)->first();
        $evaluasi = Evaluasi::with(['detail', 'rumahWalet'])->where([['rumah_walet_id', $id], ['semester', $semester]])->first();

        $detailAda = !empty(optional($evaluasi)->detail);
        $data = [
            'title' => 'Evaluasi Supplier Sbw',
            'semester' => $semester,
            'rumahWalet' => $rumahWalet,
            'supplier' => optional($evaluasi)->supplier,
            'evaluasi' => $evaluasi,
            'detailAda' => $detailAda,
        ];

        return view('pur.seleksi.daftar_supplier.evaluasi_sbw', $data);
    }


    public function evaluasi_sbw_update(Request $r)
    {
        $id = $r->rumah_walet_id;
        try {
            DB::beginTransaction();
            $evaluasi =  Evaluasi::updateOrCreate(
                [
                    'rumah_walet_id' => $id,
                    'semester' => $r->semester,
                ],
                [
                    'rumah_walet_id' => $id,
                    'semester' => $r->semester,
                    'tgl' => $r->tgl,
                ],
            );
            $evaluasi->detail()->delete();

            $evaluasi->detail()->create([
                'jenis_kriteria' => 'harga',
                'tanggal_ketidaksesuaian' => now(),
                'alasan' => $r->harga_keterangan ?? null,
                'penilaian' => $r->harga_penilaian ?? 0,
            ]);

            $evaluasi->detail()->create([
                'jenis_kriteria' => 'komunikasi',
                'tanggal_ketidaksesuaian' => now(),
                'alasan' => $r->harga_keterangan ?? null,
                'penilaian' => $r->komunikasi_penilaian ?? 0,
            ]);

            $kuantitas = collect($r->kuantitas_tanggal)->map(function ($tanggal, $index) use ($r) {
                return [
                    'jenis_kriteria' => 'kuantitas',
                    'tanggal_ketidaksesuaian' => $tanggal,
                    'alasan' => $r->kuantitas_karena[$index] ?? null,
                    'penilaian' => $r->kuantitas_penilaian[$index] ?? 0,
                ];
            });

            $waktu = collect($r->waktu_tanggal)->map(function ($tanggal, $index) use ($r) {
                return [
                    'jenis_kriteria' => 'waktu',
                    'tanggal_ketidaksesuaian' => $tanggal,
                    'alasan' => $r->waktu_karena[$index] ?? null,
                    'penilaian' => $r->waktu_penilaian[$index] ?? 0,
                ];
            });

            $kualitas = collect($r->kualitas_tanggal)->map(function ($tanggal, $index) use ($r) {
                return [
                    'jenis_kriteria' => 'kualitas',
                    'tanggal_ketidaksesuaian' => $tanggal,
                    'alasan' => $r->kualitas_karena[$index] ?? null,
                    'penilaian' => $r->kualitas_penilaian[$index] ?? 0,
                ];
            });

            $evaluasi->detail()->createMany($kuantitas->merge($waktu)->merge($kualitas)->toArray());

            // 🔹 Hitung total setelah semua detail tersimpan
            $evaluasi->load('detail'); // refresh relasi

            $kuantitas = $evaluasi->detail->where('jenis_kriteria', 'kuantitas')->whereNotNull('alasan');
            $waktu = $evaluasi->detail->where('jenis_kriteria', 'waktu')->whereNotNull('alasan');
            $kualitas = $evaluasi->detail->where('jenis_kriteria', 'kualitas')->whereNotNull('alasan');
            $harga = $evaluasi->detail->where('jenis_kriteria', 'harga')->first();
            $komunikasi = $evaluasi->detail->where('jenis_kriteria', 'komunikasi')->first();

            $totalPenilaian =
                ($kuantitas->avg('penilaian') ?? 100) +
                ($waktu->avg('penilaian') ?? 100) +
                ($kualitas->avg('penilaian') ?? 100) +
                ($harga ? $harga->penilaian : 100) +
                ($komunikasi ? $komunikasi->penilaian : 100);

            $rataRata = $totalPenilaian / 5;

            RumahWalet::find($id)->update([
                'hasil_evaluasi' => $rataRata,
            ]);

            DB::commit();
            return redirect()->back()->with('sukses', 'Evaluasi Supplier berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }



    public function evaluasi_print_sbw(Request $r)
    {
        $rumah_walet_id = $r->rumah_walet_id;
        $semester = $r->semester ?? 1;
        $supplier = RumahWalet::where('id', $rumah_walet_id)->first();
        $data = [
            'title' => 'EVALUASI SUPPLIER/OUTSOURCE',
            'dok' => 'Dok.No.: FRM.PURS.01.05, Rev.00',
            'supplier' => $supplier,
            'evaluasi' => Evaluasi::where([['rumah_walet_id', $rumah_walet_id], ['semester', $semester]])->latest()->first(),
        ];
        return view('pur.seleksi.daftar_supplier.print_evaluasi_sbw', $data);
    }

    public function edit($id, $kategori)
    {
        $supplier = $kategori == 'lainnya' ? RumahWalet::where('id', $id)->first() : Suplier::where('id', $id)->first();
        $data = [
            'title' => 'Edit Daftar Supplier',
            'supplier' => $supplier,
            'kategori' => $kategori ?? 'barang',
            'id' => $id,
        ];

        return view('pur.seleksi.daftar_supplier.edit', $data);
    }

    public function create(Request $r)
    {
        $kategori = $r->kategori ?? 'barang';
        $data = [
            'title' => 'Tambah Daftar Supplier',
            'kategori' => $kategori,
        ];

        return view('pur.seleksi.daftar_supplier.create', $data);
    }

    public function store(Request $r)
    {

        DB::beginTransaction();
        try {
            for ($i = 0; $i < count($r->nama_supplier); $i++) {
                if ($r->kategori == 'lainnya') {
                    RumahWalet::create([
                        'nama' => $r->nama_supplier[$i],
                        'alamat' => $r->alamat_supplier[$i],
                        'contact_person' => $r->contact_person[$i],
                        'no_telp' => $r->no_telp[$i],
                        'no_reg' => $r->no_reg[$i],
                        'kode' => $r->kode[$i],
                    ]);
                } else {
                    Suplier::create([
                        'nama_supplier' => $r->nama_supplier[$i],
                        'kategori' => $r->jenis_produk[$i],
                        'alamat' => $r->alamat_supplier[$i],
                        'produsen' => 0,
                        'contact_person' => $r->contact_person[$i],
                        'no_telp' => $r->no_telp[$i],
                        'ket' => $r->keterangan[$i],
                        'hasil_evaluasi' => 0,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('pur.seleksi.1.index', ['kategori' => $r->kategori])->with('sukses', 'Seleksi Supplier berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function update(Request $r, $id)
    {
        DB::beginTransaction();

        try {

            if ($r->kategori == 'lainnya') {
                RumahWalet::find($id)->update([
                    'nama' => $r->nama_supplier,
                    'alamat' => $r->alamat_supplier,
                    'contact_person' => $r->contact_person,
                    'no_telp' => $r->no_telp,
                    'no_reg' => $r->no_reg,
                    'kode' => $r->kode
                ]);
            } else {

                Suplier::find($id)->update([
                    'nama_supplier' => $r->nama_supplier,
                    'kategori' => $r->jenis_produk,
                    'alamat' => $r->alamat_supplier,
                    'produsen' => 0,
                    'contact_person' => $r->contact_person,
                    'no_telp' => $r->no_telp,
                    'ket' => $r->keterangan,
                    'hasil_evaluasi' => 0,
                ]);
            }

            DB::commit();

            return redirect()->route('pur.seleksi.1.index', ['kategori' => $r->kategori])->with('sukses', 'Seleksi Supplier berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function destroy($id)
    {
        $supplier = Suplier::findOrFail($id);
        $check = PurchaseOrder::where('supplier', $supplier->nama_supplier)->first();
        if ($check) {
            return redirect()->back()->with('error', 'Gagal menghapus, supplier masih digunakan di Purchase Order');
        } else {
            $supplier->delete();
        }

        return redirect()->back()->with('sukses', 'Seleksi Supplier berhasil dihapus');
    }
    public function print(Request $r)
    {
        $datas = Suplier::with('barang', 'evaluasi')->where('kategori', $r->kategori)->latest()->get();

        $kode = [
            'lainnya' => 'PURS.01.03',
            'barang' => 'PURB.01.03',
            'kemasan' => 'PURK.01.03',
            'jasa' => 'PURJ.01.01',
        ];
        $nomor = $kode[$r->kategori] ?? 'PURS.01.03';

        $data = [
            'title' => "DAFTAR SUPPLIER " . strtoupper($r->kategori == 'lainnya' ? 'MATERIAL SBW' : $r->kategori),
            'dok' => "Dok.No.: FRM.$nomor, Rev.00",
            'datas' => $datas,
            'kategori' => $r->kategori,
            'rumah_walet' => DB::table('rumah_walet')->orderByDesc('id')->get(),
            'k' => $r->kategori != 'lainnya' ? 'satu' : 'lainnya',
            'jenis_supplier' => $r->kategori != 'lainnya' ? ucfirst($r->kategori) : 'Supplier Material SBW',
        ];
        return view('pur.seleksi.daftar_supplier.print', $data);
    }
}

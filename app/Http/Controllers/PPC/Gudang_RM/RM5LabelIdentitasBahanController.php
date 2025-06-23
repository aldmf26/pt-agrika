<?php

namespace App\Http\Controllers\PPC\Gudang_RM;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Identitas;
use App\Models\LabelIdentitasBahan;
use App\Models\PenerimaanHeader;
use App\Models\PenerimaanKemasanHeader;
use App\Models\PenerimaanKemasanSbwKotorHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RM5LabelIdentitasBahanController extends Controller
{
    public function index()
    {
        // $label = LabelIdentitasBahan::with('barang')->latest()->get();
        // $barangs = Barang::with(['penerimaan', 'penerimaanKemasan', 'kode_bahan_baku', 'supplier'])->get();
        // $sbw = PenerimaanKemasanSbwKotorHeader::get();

        $barangs = PenerimaanHeader::with(['barang', 'supplier'])->where('label', 'Y')->get();
        $kemasan = PenerimaanKemasanHeader::with(['barang', 'supplier'])->where('label', 'Y')->get();
        $sbw = DB::table('sbw_kotor')
            ->leftJoin('grade_sbw_kotor', 'grade_sbw_kotor.id', '=', 'sbw_kotor.grade_id')
            ->leftJoin('rumah_walet', 'rumah_walet.id', '=', 'sbw_kotor.rwb_id')
            ->select('grade_sbw_kotor.nama as grade', 'rumah_walet.nama as rumah_walet', 'sbw_kotor.*')
            ->get();

        $items = [];
        // Tambahkan data SBW
        foreach ($barangs as $s) {
            $items[] = [
                'id' => $s->id,
                'identitas' => 'barang',
                'nama_barang' => $s->barang->nama_barang,
                'nama_produsen' => $s->supplier->nama_supplier,
                'tanggal_kedatangan' => $s->tanggal_terima,
                'kode_lot' => $s->kode_lot,
                'kode_grading' => '-',
                'keterangan' => '-',
            ];
        }
        // Tambahkan data SBW
        foreach ($kemasan as $s) {
            $items[] = [
                'id' => $s->id,
                'identitas' => 'kemasan',
                'nama_barang' => $s->barang->nama_barang,
                'nama_produsen' => $s->supplier->nama_supplier,
                'tanggal_kedatangan' => $s->tanggal_penerimaan,
                'kode_lot' => $s->kode_lot,
                'kode_grading' => '-',
                'keterangan' => '-',
            ];
        }

        foreach ($sbw as $s) {
            $items[] = [
                'id' => $s->id,
                'identitas' => 'sbw',
                'nama_barang' => $s->grade,
                'nama_produsen' => $s->rumah_walet,
                'tanggal_kedatangan' => date('Y-m-d', strtotime('+1 day', strtotime($s->tgl))),
                'kode_lot' => $s->no_invoice,
                'kode_grading' => '-',
                'keterangan' => $s->nm_partai,
            ];
        }


        $data = [
            'title' => 'Label Identitas Bahan',
            'items' => collect($items), // tinggal pakai satu loop
        ];
        return view('ppc.gudang_rm.label_identitas_bahan.index', $data);
    }
    public function create()
    {
        $barangs = Barang::whereNotExists(function ($query) {
            $query->selectRaw(1)
                ->from('label_identitas_bahan_baku as a')
                ->whereRaw('a.id_barang = barang.id');
        })->latest()->get();

        $penerimaanBarang = PenerimaanHeader::where('label', 'T')->orderByDesc('id')->get();
        $penerimaan = PenerimaanKemasanHeader::where('label', 'T')->orderByDesc('id')->get();

        // $penerimaan = PenerimaanKemasanSbwKotorHeader::latest()->get();
        $identitas = Identitas::all();
        $data = [
            'title' => 'Tambah Label Identitas Bahan',
            'barangs' => $barangs,
            'identitas' => $identitas,
            'penerimaan' => $penerimaan,
            'penerimaanBarang' => $penerimaanBarang,
        ];
        return view('ppc.gudang_rm.label_identitas_bahan.create', $data);
    }

    public function store(Request $r)
    {
        $no_boxPecah = explode(',', $r->barangChecked); //split string to array

        PenerimaanKemasanHeader::whereIn('kode_lot', $no_boxPecah)
            ->update(['label' => 'Y']);
        PenerimaanHeader::whereIn('kode_lot', $no_boxPecah)
            ->update(['label' => 'Y']);

        // foreach ($barang as $b) {
        //     LabelIdentitasBahan::create([
        //         'identitas' => $r->identitas,
        //         'id_barang' => $b->id_barang,
        //         'tgl_kedatangan' => $b->tanggal_penerimaan,
        //         'noregrbw_nmprodusen' =>  $b->id_supplier,
        //         'keterangan' => $b->keputusan,
        //     ]);
        // }
        return redirect()->route('ppc.gudang-rm.5.index')->with('sukses', 'Data berhasil disimpan');
    }

    public function print(Request $r)
    {
        $checked = $r->query('checked'); // e.g., "1:barang,2:kemasan,3:sbw"
        if (!$checked) {
            return redirect()->back()->with('error', 'No items selected for printing.');
        }

        $checkedItems = explode(',', $checked); // Split into array: ["1:barang", "2:kemasan", "3:sbw"]
        $labels = collect();
        foreach ($checkedItems as $item) {
            if (!str_contains($item, ':')) {
                continue; // Skip invalid format
            }

            [$id, $identitas] = explode(':', $item);

            if (!in_array($identitas, ['barang', 'kemasan', 'sbw'])) {
                continue; // Skip invalid identitas or non-numeric ID
            }
            if ($identitas === 'kemasan') {
                $kemasan = PenerimaanKemasanHeader::with(['barang', 'supplier'])->where('kode_lot', $id)->first();
                if ($kemasan) {
                    // Ensure supplier is an object
                    $kemasan->supplier = $kemasan->supplier ?? (object)['nama_supplier' => '-'];
                    // Set kategori explicitly
                    $kemasan->kategori = 'kemasan';
                    // Ensure kode_barang is set
                    $kemasan->kode_barang = $kemasan->barang->kode_lot ?? '-';
                    // Ensure penerimaan or penerimaanKemasan is a collection
                    $kemasan->penerimaan = collect([
                        (object)[
                            'tanggal_terima' => $kemasan->tanggal_penerimaan,
                            'kode_lot' => $kemasan->kode_lot,
                            'keterangan' => '-',
                        ]
                    ]);
                    $labels->push($kemasan);
                }
            }
            if ($identitas === 'barang') {
                $kemasan = PenerimaanHeader::with(['barang', 'supplier'])->where('kode_lot', $id)->first();
                if ($kemasan) {
                    // Ensure supplier is an object
                    $kemasan->supplier = $kemasan->supplier ?? (object)['nama_supplier' => '-'];
                    // Set kategori explicitly
                    $kemasan->kategori = 'barang';
                    // Ensure kode_barang is set
                    $kemasan->kode_barang = $kemasan->barang->kode_lot ?? '-';
                    // Ensure penerimaan or penerimaanKemasan is a collection
                    $kemasan->penerimaan = collect([
                        (object)[
                            'tanggal_terima' => $kemasan->tanggal_terima,
                            'kode_lot' => $kemasan->kode_lot,
                            'keterangan' =>  '-',
                        ]
                    ]);
                    $labels->push($kemasan);
                }
            }
            if ($identitas === 'sbw') {
                $kemasan = DB::table('sbw_kotor')
                    ->leftJoin('grade_sbw_kotor', 'grade_sbw_kotor.id', '=', 'sbw_kotor.grade_id')
                    ->leftJoin('rumah_walet', 'rumah_walet.id', '=', 'sbw_kotor.rwb_id')
                    ->select('grade_sbw_kotor.nama as grade', 'grade_sbw_kotor.kode', 'rumah_walet.nama as rumah_walet', 'sbw_kotor.*')
                    ->where('sbw_kotor.no_invoice', $id)
                    ->first();
                if ($kemasan) {
                    // Ensure supplier is an object
                    $kemasan->supplier = $kemasan->rumah_walet ?? (object)['nama_supplier' => '-'];
                    // Set kategori explicitly
                    $kemasan->kategori = 'Baku';
                    // Ensure kode_barang is set
                    $kemasan->kode_barang = $kemasan->no_invoice ?? '-';
                    // Ensure penerimaan or penerimaanKemasan is a collection
                    $kemasan->penerimaan = collect([
                        (object)[
                            'tanggal_terima' =>  date('Y-m-d', strtotime('+1 day', strtotime($kemasan->tgl))),
                            'kode_lot' => $kemasan->no_invoice,
                            'keterangan' => $kemasan->nm_partai,
                        ]
                    ]);
                    $labels->push($kemasan);
                }
            }


            // if ($identitas === 'barang') {
            //     $barang = Barang::with(['penerimaan', 'penerimaanKemasan', 'kode_bahan_baku', 'supplier'])
            //         ->where('id', $id)
            //         ->where('kategori', $identitas)
            //         ->first();

            //     if ($barang) {
            //         // Ensure supplier is an object
            //         $barang->supplier = $barang->supplier ?? (object)['nama_supplier' => '-'];
            //         // Set kategori explicitly
            //         $barang->kategori = $identitas;
            //         // Ensure kode_barang is set
            //         $barang->kode_barang = $barang->kode_barang ?? '-';
            //         // Ensure penerimaan or penerimaanKemasan is a collection
            //         $barang->penerimaan = $identitas === 'barang' ? $barang->penerimaan : collect();
            //         $barang->penerimaanKemasan = $identitas === 'kemasan' ? $barang->penerimaanKemasan : collect();
            //         $labels->push($barang);
            //     }
            // } elseif ($identitas === 'kemasan') {
            //     $sbw = PenerimaanKemasanHeader::where('id', $id)->first();

            //     if ($sbw) {
            //         // Structure SBW to match Barang model expectations
            //         $sbw->kategori = 'sbw';
            //         $sbw->nama_barang = $sbw->jenis;
            //         $sbw->kode_barang = '-';
            //         $sbw->supplier = (object)['nama_supplier' => $sbw->noreg_rumah_walet ?? '-'];
            //         // Simulate penerimaan-like structure for consistency
            //         $sbw->penerimaan = collect([
            //             (object)[
            //                 'tanggal_terima' => $sbw->tgl_penerimaan,
            //                 'kode_lot' => $sbw->no_lot,
            //             ]
            //         ]);
            //         $sbw->penerimaanKemasan = collect(); // Empty for SBW
            //         $labels->push($sbw);
            //     }
            // } elseif ($identitas === 'sbw') {
            //     $sbw = PenerimaanKemasanSbwKotorHeader::where('id', $id)->first();

            //     if ($sbw) {
            //         // Structure SBW to match Barang model expectations
            //         $sbw->kategori = 'sbw';
            //         $sbw->nama_barang = $sbw->jenis;
            //         $sbw->kode_barang = '-';
            //         $sbw->supplier = (object)['nama_supplier' => $sbw->noreg_rumah_walet ?? '-'];
            //         // Simulate penerimaan-like structure for consistency
            //         $sbw->penerimaan = collect([
            //             (object)[
            //                 'tanggal_terima' => $sbw->tgl_penerimaan,
            //                 'kode_lot' => $sbw->no_lot,
            //             ]
            //         ]);
            //         $sbw->penerimaanKemasan = collect(); // Empty for SBW
            //         $labels->push($sbw);
            //     }
            // }
        }

        if ($labels->isEmpty()) {
            return redirect()->back()->with('error', 'No valid items found for printing.');
        }
        $data = [
            'labels' => $labels,
        ];
        return view('ppc.gudang_rm.label_identitas_bahan.print', $data);
    }
}

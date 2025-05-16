<?php

namespace App\Http\Controllers\PPC\Gudang_RM;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Identitas;
use App\Models\LabelIdentitasBahan;
use App\Models\PenerimaanKemasanSbwKotorHeader;
use Illuminate\Http\Request;

class RM5LabelIdentitasBahanController extends Controller
{
    public function index()
    {
        // $label = LabelIdentitasBahan::with('barang')->latest()->get();
        // $barangs = Barang::with(['penerimaan', 'penerimaanKemasan', 'kode_bahan_baku', 'supplier'])->get();
        // $sbw = PenerimaanKemasanSbwKotorHeader::get();

        $barangs = Barang::with(['penerimaan', 'penerimaanKemasan', 'kode_bahan_baku', 'supplier'])->get();
        $sbw = PenerimaanKemasanSbwKotorHeader::get();

        /// Loop data barang & kemasan
        foreach ($barangs as $barang) {
            if ($barang->kategori == 'barang' && $barang->penerimaan->isNotEmpty()) {
                foreach ($barang->penerimaan as $p) {
                    $items[] = [
                        'id' => $barang->id,
                        'identitas' => 'barang',
                        'nama_barang' => $barang->nama_barang,
                        'nama_produsen' => $barang->supplier->nama_supplier,
                        'tanggal_kedatangan' => $p->tanggal_terima,
                        'kode_lot' => $p->kode_lot,
                        'kode_grading' => $barang->kode_barang,
                    ];
                }
            } elseif ($barang->kategori == 'kemasan' && $barang->penerimaanKemasan->isNotEmpty()) {
                foreach ($barang->penerimaanKemasan as $p) {
                    $items[] = [
                        'id' => $barang->id,
                        'identitas' => 'kemasan',
                        'nama_barang' => $barang->nama_barang,
                        'nama_produsen' => $barang->supplier->nama_supplier,
                        'tanggal_kedatangan' => $p->tanggal_penerimaan,
                        'kode_lot' => $p->kode_lot,
                        'kode_grading' => $barang->kode_barang,
                    ];
                }
            }
        }

        // Tambahkan data SBW
        foreach ($sbw as $s) {
            $items[] = [
                'id' => $s->id,
                'identitas' => 'sbw',
                'nama_barang' => $s->jenis,
                'nama_produsen' => $s->noreg_rumah_walet,
                'tanggal_kedatangan' => $s->tgl_penerimaan,
                'kode_lot' => $s->no_lot,
                'kode_grading' => '-',
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

        $penerimaan = PenerimaanKemasanSbwKotorHeader::latest()->get();
        $identitas = Identitas::all();
        $data = [
            'title' => 'Tambah Label Identitas Bahan',
            'barangs' => $barangs,
            'identitas' => $identitas,
            'penerimaan' => $penerimaan
        ];
        return view('ppc.gudang_rm.label_identitas_bahan.create', $data);
    }

    public function store(Request $r)
    {
        LabelIdentitasBahan::create([
            'identitas' => $r->identitas,
            'id_barang' => $r->id_barang,
            'tgl_kedatangan' => $r->tgl_kedatangan,
            'noregrbw_nmprodusen' => $r->noregrbw ?? $r->nmprodusen,
            'keterangan' => $r->keterangan,
        ]);
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

            if (!in_array($identitas, ['barang', 'kemasan', 'sbw']) || !is_numeric($id)) {
                continue; // Skip invalid identitas or non-numeric ID
            }

            if ($identitas === 'barang' || $identitas === 'kemasan') {
                $barang = Barang::with(['penerimaan', 'penerimaanKemasan', 'kode_bahan_baku', 'supplier'])
                    ->where('id', $id)
                    ->where('kategori', $identitas)
                    ->first();

                if ($barang) {
                    // Ensure supplier is an object
                    $barang->supplier = $barang->supplier ?? (object)['nama_supplier' => '-'];
                    // Set kategori explicitly
                    $barang->kategori = $identitas;
                    // Ensure kode_barang is set
                    $barang->kode_barang = $barang->kode_barang ?? '-';
                    // Ensure penerimaan or penerimaanKemasan is a collection
                    $barang->penerimaan = $identitas === 'barang' ? $barang->penerimaan : collect();
                    $barang->penerimaanKemasan = $identitas === 'kemasan' ? $barang->penerimaanKemasan : collect();
                    $labels->push($barang);
                }
            } elseif ($identitas === 'sbw') {
                $sbw = PenerimaanKemasanSbwKotorHeader::where('id', $id)->first();

                if ($sbw) {
                    // Structure SBW to match Barang model expectations
                    $sbw->kategori = 'sbw';
                    $sbw->nama_barang = $sbw->jenis;
                    $sbw->kode_barang = '-';
                    $sbw->supplier = (object)['nama_supplier' => $sbw->noreg_rumah_walet ?? '-'];
                    // Simulate penerimaan-like structure for consistency
                    $sbw->penerimaan = collect([
                        (object)[
                            'tanggal_terima' => $sbw->tgl_penerimaan,
                            'kode_lot' => $sbw->no_lot,
                        ]
                    ]);
                    $sbw->penerimaanKemasan = collect(); // Empty for SBW
                    $labels->push($sbw);
                }
            }
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

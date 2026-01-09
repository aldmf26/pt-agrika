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
use Illuminate\Support\Facades\Http;

class RM5LabelIdentitasBahanController extends Controller
{
    public function index(Request $r)
    {
        // $label = LabelIdentitasBahan::with('barang')->latest()->get();
        // $barangs = Barang::with(['penerimaan', 'penerimaanKemasan', 'kode_bahan_baku', 'supplier'])->get();
        // $sbw = PenerimaanKemasanSbwKotorHeader::get();
        $k = $r->kategori;

        $barangs = PenerimaanHeader::with(['barang', 'supplier'])->latest()->get();
        $kemasan = PenerimaanKemasanHeader::with(['barang', 'supplier'])->latest()->get();
        $sbw = DB::table('sbw_kotor')
            ->leftJoin('grade_sbw_kotor', 'grade_sbw_kotor.id', '=', 'sbw_kotor.grade_id')
            ->leftJoin('rumah_walet', 'rumah_walet.id', '=', 'sbw_kotor.rwb_id')
            ->orderBy('sbw_kotor.tgl', 'desc')
            ->select('grade_sbw_kotor.nama as grade', 'rumah_walet.nama as rumah_walet', 'sbw_kotor.*')
            ->get();

        $items = [];
        // Tambahkan data SBW


        $items = [];

        $items = match ($k ?: 'barang') {
            'barang' => $barangs->map(fn($s) => [
                'id' => $s->id,
                'identitas' => 'barang',
                'nama_barang' => $s->barang->nama_barang,
                'nama_produsen' => $s->barang->supplier->nama_supplier,
                'tanggal_kedatangan' => $s->tanggal_terima,
                'kode_lot' => $s->kode_lot,
                'kode_grading' => '-',
                'keterangan' => '-',
            ])->toArray(),
            'kemasan' => $kemasan->map(fn($s) => [
                'id' => $s->id,
                'identitas' => 'kemasan',
                'nama_barang' => $s->barang->nama_barang,
                'nama_produsen' => $s->barang->supplier->nama_supplier,
                'tanggal_kedatangan' => $s->tanggal_penerimaan,
                'kode_lot' => $s->kode_lot,
                'kode_grading' => '-',
                'keterangan' => '-',
            ])->toArray(),
            'lainnya' => $sbw->map(fn($s) => [
                'id' => $s->id,
                'identitas' => 'sbw',
                'nama_barang' => $s->grade,
                'nama_produsen' => $s->rumah_walet,
                'tanggal_kedatangan' => date('Y-m-d', strtotime('+1 day', strtotime($s->tgl))),
                'kode_lot' => $s->no_invoice,
                'kode_grading' => '-',
                'keterangan' => $s->nm_partai,
            ])->toArray(),
            default => [],
        };


        $data = [
            'title' => 'Label Identitas Bahan',
            'items' => collect($items), // tinggal pakai satu loop
            'k' => $k,
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
                    $kemasan->supplier = $kemasan->supplier->nama_supplier ?? (object)['nama_supplier' => '-'];
                    // Set kategori explicitly
                    $kemasan->kategori = 'kemasan';
                    // Ensure kode_barang is set
                    $kemasan->kode_barang = $kemasan->barang->kode_lot ?? '-';
                    $kemasan->keterangan = '-';
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
                    $kemasan->supplier = $kemasan->supplier->nama_supplier ?? (object)['nama_supplier' => '-'];
                    // Set kategori explicitly
                    $kemasan->kategori = 'barang';
                    // Ensure kode_barang is set
                    $kemasan->kode_barang = $kemasan->barang->kode_lot ?? '-';
                    $kemasan->keterangan =  '-';
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
                $bk = Http::get("https://sarang.ptagafood.com/api/apihasap/no_box_label_detail?no_box=$id");

                $bk = json_decode($bk, TRUE);
                $bk = $bk['data'];

                $kemasan = DB::table('sbw_kotor')
                    ->leftJoin('grade_sbw_kotor', 'sbw_kotor.grade_id', '=', 'grade_sbw_kotor.id')
                    ->leftJoin('rumah_walet', 'sbw_kotor.rwb_id', '=', 'rumah_walet.id')
                    ->select('sbw_kotor.*', 'sbw_kotor.no_invoice', 'grade_sbw_kotor.kode', 'grade_sbw_kotor.nama as grade', 'rumah_walet.nama as rumah_walet')

                    ->first();
                if ($kemasan) {
                    // Ensure supplier is an object
                    $kemasan->supplier = $sbw->rumah_walet ?? (object)['nama_supplier' => '-'];
                    // Set kategori explicitly
                    $kemasan->kategori = 'Baku';
                    // Ensure kode_barang is set
                    $kemasan->kode_barang = $kemasan->no_invoice ?? '-';
                    $kemasan->keterangan = $kemasan->nm_partai;
                    $kemasan->no_invoice = $bk['kode_lot'];
                    $kemasan->pcs = $bk['pcs_awal'];
                    $kemasan->gr = $bk['gr_awal'];


                    // Ensure penerimaan or penerimaanKemasan is a collection
                    $kemasan->penerimaan = collect([
                        (object)[
                            'tanggal_terima' =>  date('Y-m-d', strtotime('+1 day', strtotime($kemasan->tgl))),
                            'kode_lot' => $kemasan->no_invoice,
                            'keterangan' => '-',
                            'no_box' => $bk['kode_lot'],
                            'pcs' => $bk['pcs_awal'],
                            'gr' => $bk['gr_awal'],
                        ]
                    ]);
                    $labels->push($kemasan);
                }
            }
        }
        if ($labels->isEmpty()) {

            return redirect()->back()->with('error', 'No valid items found for printing.');
        }
        $data = [
            'labels' => $labels,
        ];

        if ($identitas === 'sbw') {

            return view('ppc.gudang_rm.label_identitas_bahan.print2', $data);
        } else {
            return view('ppc.gudang_rm.label_identitas_bahan.print', $data);
        }
    }
}

<?php

namespace App\Http\Controllers\PUR\Pembelian;

use App\Http\Controllers\Controller;
use App\Models\DataPegawai;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\PurchaseRequestItem;
use App\Models\Suplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PUR2PurchaseOrderController extends Controller
{
    public function singkron()
    {
        $sbw = Http::get("https://gudangsarang.ptagafood.com/api/sbw/sbw_kotor");
        $sbw = json_decode($sbw, TRUE);

        $sbw = $sbw['data']['sbw'];

        DB::table('sbw_kotor')->truncate();

        foreach ($sbw as $s) {
            DB::table('sbw_kotor')->insert([
                'grade_id' => $s['grade_id'],
                'rwb_id' => $s['rwb_id'],
                'nm_partai' => $s['nm_partai'],
                'no_invoice' => $s['no_invoice'],
                'pcs' => $s['pcs'],
                'kg' => $s['kg'],
                'no_kendaraan' => $s['no_kendaraan'],
                'pengemudi' => $s['pengemudi'],
                'tgl' => $s['tgl'],
            ]);
        }

        // Ambil nomor PR terakhir dari purchase_requests
        $lastNoPr = PurchaseOrder::latest()->first()->no_po ?? null;
        $lastNumber = 0;
        if ($lastNoPr) {
            $parts = explode('/', $lastNoPr);
            if (isset($parts[1])) {
                $lastNumber = (int) $parts[1];
            }
        }

        // Ambil data sbw_kotor urut ASC untuk hitung no PR
        $dataAsc = DB::table('sbw_kotor as a')
            ->leftJoin('rumah_walet as b', 'b.id', '=', 'a.rwb_id')
            ->groupBy('a.tgl', 'a.rwb_id')
            ->selectRaw("a.tgl, a.rwb_id, b.nama as supplier, b.alamat as alamat_pengiriman")
            ->orderBy('a.tgl', 'ASC')
            ->get();

        // Format bulan romawi
        $bulanRomawi = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII'
        ];

        foreach ($dataAsc as $i => $item) {
            $noUrut = $lastNumber + ($i + 1);

            // Ambil bulan dan tahun dari tanggal data, bukan tanggal sekarang
            $tanggalData = Carbon::parse($item->tgl);
            $bulan = $bulanRomawi[$tanggalData->month];
            $tahun = $tanggalData->year;

            $item->no_po = "PO/{$noUrut}/{$bulan}/{$tahun}";
        }

        // Balik lagi ke DESC untuk ditampilkan
        $datas = $dataAsc->sortByDesc('tgl')->values();
        return $datas;
    }

    public function index(Request $r)
    {
        $kategori = $r->kategori ?? 'barang';

        if ($kategori != 'lainnya') {
            $datas = PurchaseOrder::with('item')
                ->whereHas('purchaseRequest', function ($q) use ($kategori) {
                    $q->where('departemen', $kategori);
                })
                ->latest()
                ->get();
        } else {
            $datas = $this->singkron();
        }

        $data = [
            'title' => 'PUR 2 Purchase Order',
            'datas' => $datas,
            'kategori' => $kategori,
        ];

        return view('pur.pembelian.purchase_order.index', $data);
    }

    public function create(Request $r)
    {
        $user = DataPegawai::admin()->get();
        $suplier = Suplier::where('kategori', $r->kategori)->latest()->get();
        $data = [
            'title' => 'Tambah Purchase Order',
            'no_po' => $this->getNoPo(),
            'supplier' => $suplier,
            'user' => $user
        ];

        return view('pur.pembelian.purchase_order.create', $data);
    }

    public function getNoPo()
    {
        $bulan = strtoupper(date('n'));
        $tahun = date('Y');
        $lastRequest = PurchaseOrder::latest()->first();

        if ($lastRequest) {
            $lastNo = (int) substr($lastRequest->no_po, 3, 2);
            $newNo = str_pad($lastNo + 1, 2, '0', STR_PAD_LEFT);
        } else {
            $newNo = '01';
        }

        $romanMonths = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        $bulanRoman = $romanMonths[$bulan - 1];

        $no_pr = "PO/{$newNo}/{$bulanRoman}/{$tahun}";

        return $no_pr;
    }

    public function selesai(Request $r)
    {
        PurchaseOrder::find($r->id)->update([
            'status' => 'terkirim'
        ]);
        return redirect()->route('pur.pembelian.2.index')->with('sukses', 'Purchase Order berhasil diselesaikan');
    }

    public function store(Request $r)
    {
        DB::beginTransaction();
        try {
            $no_po = $this->getNoPo();
            $tgl = $r->tgl;
            $ttlHarga = array_sum($r->harga);
            $pr = PurchaseOrder::create([
                'no_po' => $no_po,
                'tgl' => $tgl,
                'supplier' => $r->supplier,
                'alamat_pengiriman' => $r->alamat,
                'pic' => $r->pic,
                'telp' => $r->telepon,
                'estimasi_kedatangan' => $r->estimasi,
                'total_harga' => $ttlHarga,
                'pr_id' => $r->id_pr,
            ]);

            foreach ($r->id as $index => $id) {
                PurchaseRequestItem::where('id', $id)
                    ->where('pr_id', $r->id_pr)
                    ->update(['harga_po' => $r->harga[$index]]);
            }

            DB::commit();

            return redirect()->route('pur.pembelian.2.index', ['kategori' => strtolower($r->kategori)])->with('sukses', 'Purchase Order berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('pur.pembelian.2.create', ['kategori' => strtolower($r->kategori)])->with('error', $e->getMessage());
        }
    }

    public function print($id)
    {
        $datas = PurchaseOrder::where('id', $id)->with('item')->first();
        $data = [
            'title' => 'PURCHASE ORDER',
            'dok' => 'Dok.No.: FRM.PUR.01.02, Rev.00',
            'datas' => $datas
        ];
        return view('pur.pembelian.purchase_order.print', $data);
    }

    public function print_sbw(Request $r)
    {
        $no_po = $r->no_po;
        $tgl = $r->tgl;
        $rwb_id = $r->rwb_id;

        $datas = DB::table('sbw_kotor as a')
            ->leftJoin('rumah_walet as b', 'b.id', '=', 'a.rwb_id')
            ->where([
                ['tgl',  $tgl],
                ['rwb_id',  $rwb_id]
            ])
            ->groupBy('a.tgl', 'a.rwb_id')
            ->selectRaw("a.tgl, a.rwb_id, b.nama as supplier, b.alamat as alamat_pengiriman")
            ->orderBy('a.tgl', 'ASC')
            ->first();

        $items = DB::table('sbw_kotor as s')
            ->join('grade_sbw_kotor as g', 'g.id', '=', 's.grade_id')
            ->where([
                ['tgl', '=', $tgl],
                ['rwb_id', '=', $rwb_id]
            ])
            ->groupBy('s.grade_id', 'g.nama') // grup per barang
            ->selectRaw('
                g.nama,
                SUM(s.pcs) as jumlah_pcs,
                SUM(s.kg) as jumlah_kg
            ')
            ->get();

        $data = [
            'title' => 'PURCHASE ORDER',
            'dok' => 'Dok.No.: FRM.PURS.01.02, Rev.00',
            'datas' => $datas,
            'kategori' => 'sbw',
            'no_po' => $no_po,
            'items' => $items,
        ];
        return view('pur.pembelian.purchase_order.print_sbw', $data);
    }
}

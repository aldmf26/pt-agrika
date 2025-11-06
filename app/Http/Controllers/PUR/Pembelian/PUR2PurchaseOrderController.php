<?php

namespace App\Http\Controllers\PUR\Pembelian;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\DataPegawai;
use App\Models\PenerimaanHeader;
use App\Models\PenerimaanKemasanHeader;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\PurchaseRequestItem;
use App\Models\PurchaseRequestSbw;
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
        $lastNoPr = PurchaseRequestSbw::latest()->first()->no_pr ?? null;
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
        $kategori = $r->kategori ?? 'barang';
        $user = DataPegawai::karyawan()->get();
        $suplier = Suplier::where('kategori', $kategori)->latest()->get();
        $data = [
            'title' => 'Tambah Purchase Order',
            'no_po' => $this->getNoPo($kategori),
            'supplier' => $suplier,
            'kategori' => $kategori,
            'user' => $user
        ];

        return view('pur.pembelian.purchase_order.create', $data);
    }

    public function getNoPo($kategori = 'barang')
    {
        $bulan = strtoupper(date('n'));
        $tahun = date('Y');
        $kode = $kategori == 'barang' ? 'POB' : 'POK';
        $lastRequest = PurchaseOrder::where('no_po', 'like', "%{$kode}%")->latest()->first();

        if ($lastRequest) {
            $lastNo = (int) substr($lastRequest->no_po, 4, 2);
            $newNo = str_pad($lastNo + 1, 2, '0', STR_PAD_LEFT);
        } else {
            $newNo = '01';
        }

        $romanMonths = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        $bulanRoman = $romanMonths[$bulan - 1];
        $no_pr = "{$kode}/{$newNo}/{$bulanRoman}/{$tahun}";

        return $no_pr;
    }

    public function selesai(Request $r)
    {
        PurchaseOrder::find($r->id)->update([
            'status' => 'terkirim'
        ]);
        return redirect()->route('pur.pembelian.2.index', ['kategori' => $r->kategori])->with('sukses', 'Purchase Order berhasil diselesaikan');
    }

    public function store(Request $r)
    {
        // $suplier = Barang::where('id', $r->id[0])->get();
        // dd($r->all(), $suplier);
        DB::beginTransaction();
        try {
            $no_po = $this->getNoPo($r->kategori);
            $tgl = $r->tgl;
            $ttlHarga = array_sum($r->harga);
            $pr = PurchaseOrder::create([
                'no_po' => $no_po,
                'tgl' => $tgl,
                'supplier' => '-',
                'alamat_pengiriman' => '-',
                'pic' => '-',
                'telp' => '-',
                'estimasi_kedatangan' => $r->estimasi,
                'total_harga' => $ttlHarga,
                'pr_id' => $r->id_pr,
            ]);

            foreach ($r->id as $index => $id) {
                $item = PurchaseRequestItem::find($id);

                if ($item && $item->pr_id == $r->id_pr) {
                    $harga = $r->harga[$index];

                    $item->update([
                        'harga_po' => $harga,
                    ]);

                    $item->barang->update([
                        'harga_satuan' => $harga,
                    ]);
                }

                // PurchaseRequestItem::where('id', $id)
                //     ->where('pr_id', $r->id_pr)
                //     ->update(['harga_po' => $r->harga[$index]]);
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
        $kepalaPurchasing = DataPegawai::where('posisi', 'KEPALA Purchasing')->first()->nama;
        $telp = "082353347405";
        $datas = PurchaseOrder::with('purchaseRequest')->where('id', $id)->with('item')->first();
        $departemen = $datas->purchaseRequest->departemen;
        $kode = $departemen == 'BARANG' ? 'PURB' : 'PURK';
        $jabatans = [
            'barang' => 'STAFF PURCHASING',
            'lainnya' => 'KEPALA GUDANG BAHAN BAKU',
            'kemasan' => 'KEPALA PACKING & GUDANG FG',
            'jasa' => 'FSTL',
        ];
        $jabatan = $jabatans[strtolower($departemen)];
        $data = [
            'title' => 'PURCHASE ORDER',
            'dok' => "Dok.No.: FRM.{$kode}.01.02, Rev.00",
            'kategori' => $departemen,
            'datas' => $datas,
            'kepalaPurchasing' => $kepalaPurchasing,
            'telp' => $telp,
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

    public function destroy($id, $kategori)
    {
        $po = PurchaseOrder::find($id);

        $penerimaanHeader = PenerimaanHeader::where('no_po', $po->no_po)->first();
        $penerimaanKemasanHeader = PenerimaanKemasanHeader::where('no_po', $po->no_po)->first();

        if ($penerimaanHeader) {
            return redirect()->route('pur.pembelian.2.index', ['kategori' => $kategori])->with('error', 'Purchase Order sudah memiliki penerimaan');
        }

        if ($penerimaanKemasanHeader) {
            return redirect()->route('pur.pembelian.2.index', ['kategori' => $kategori])->with('error', 'Purchase Order sudah memiliki penerimaan kemasan');
        }

        $po->delete();

        return redirect()->route('pur.pembelian.2.index', ['kategori' => $kategori])->with('sukses', 'Data berhasil dihapus');
    }
}

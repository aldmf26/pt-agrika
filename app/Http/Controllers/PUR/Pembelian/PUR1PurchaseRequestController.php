<?php

namespace App\Http\Controllers\PUR\Pembelian;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\DataPegawai;
use App\Models\PurchaseOrder;
use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestItem;
use App\Models\PurchaseRequestSbw;
use App\Models\Suplier;
use App\Models\User;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PUR1PurchaseRequestController extends Controller
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
                $lastNumber = $parts[1];
            }
        }

        // Ambil data sbw_kotor urut ASC untuk hitung no PR
        $dataAsc = DB::table('sbw_kotor')
            ->groupBy('tgl', 'rwb_id')
            ->selectRaw("tgl, rwb_id")
            ->orderBy('tgl', 'ASC')
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

        // Generate nomor PR sesuai ASC
        foreach ($dataAsc as $i => $item) {
            $noUrut = $lastNumber + ($i + 1);

            // Ambil bulan dan tahun dari tanggal data, bukan tanggal sekarang
            $tanggalData = Carbon::parse($item->tgl);
            $bulan = $bulanRomawi[$tanggalData->month];
            $tahun = $tanggalData->year;

            $item->no_pr = "PRS/{$noUrut}/{$bulan}/{$tahun}";
        }

        // Balik lagi ke DESC untuk ditampilkan
        $datas = $dataAsc->sortByDesc('tgl')->values();
        return $datas;
    }
    public function index()
    {
        $kategori = request()->kategori ?? 'barang';


        $datas = $kategori == 'lainnya' ? $this->singkron() : PurchaseRequest::where('departemen', $kategori)->latest()->get();
        $data = [

            'title' => 'PUR 1 Purchase Request',
            'datas' => $datas,
            'kategori' => $kategori,
        ];

        return view('pur.pembelian.purchase_request.index', $data);
    }

    public function create(Request $r)
    {
        $kategori = $r->kategori ?? 'barang';
        $idSupplier = $r->idSupplier ?? null;
        $barangs = Barang::with('supplier')
            ->where('kategori', $kategori)
            ->when($idSupplier, function ($query) use ($idSupplier) {
                $query->where('supplier_id', $idSupplier);
            })
            ->get();
        $user = DataPegawai::karyawan()->get();
        $supplier = Suplier::where('kategori', $kategori)->get();
        $data = [
            'title' => 'Tambah Purchase Request',
            'no_pr' => $this->getNoPr($kategori),
            'barangs' => $barangs,
            'kategori' => $kategori,
            'supplier' => $supplier,
            'idSupplier' => $idSupplier,
            'user' => $user,
        ];

        return view('pur.pembelian.purchase_request.create', $data);
    }

    public function getNoPr($departemen = 'barang')
    {
        $bulan = strtoupper(date('n'));
        $tahun = date('Y');
        $lastRequest = PurchaseRequest::where('departemen', $departemen)->latest()->first();

        if ($lastRequest) {
            $lastNo = (int) substr($lastRequest->no_pr, 4, 1);
            $newNo = str_pad($lastNo + 1, 1, '0', STR_PAD_LEFT);
        } else {
            $newNo = '1';
        }

        $romanMonths = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        $bulanRoman = $romanMonths[$bulan - 1];
        $kode = $departemen == 'barang' ? 'PRB' : 'PRK';
        $no_pr = "{$kode}/{$newNo}/{$bulanRoman}/{$tahun}";

        return $no_pr;
    }

    public function store(Request $r)
    {
        DB::beginTransaction();
        try {
            $no_pr = $this->getNoPr($r->departemen);
            $tgl = $r->tgl;

            $pr = PurchaseRequest::create([
                'no_pr' => $no_pr,
                'tgl' => $tgl,
                'diminta_oleh' => $r->diminta_oleh,
                'posisi' => $r->posisi,
                'departemen' => $r->departemen,
                'manager_departemen' => '0',
                'alasan_permintaan' => $r->alasan_permintaan,
            ]);

            for ($i = 0; $i < count($r->jumlah); $i++) {
                PurchaseRequestItem::create([
                    'pr_id' => $pr->id,
                    'jumlah' => $r->jumlah[$i],
                    'item_spesifikasi' => $r->item_spesifikasi[$i],
                    'tgl_dibutuhkan' => $r->tgl_dibutuhkan[$i],
                ]);
            }

            DB::commit();

            return redirect()->route('pur.pembelian.1.index', ['kategori' => $r->kategori])->with('sukses', 'Purchase Request berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('pur.pembelian.1.create', ['kategori' => $r->kategori])->with('error', $e->getMessage());
        }
    }



    public function selesai($id, $kategori)
    {
        PurchaseRequest::where('id', $id)->update(['status' => 'disetujui']);
        return redirect()->route('pur.pembelian.1.index', ['kategori' => $kategori])->with('sukses', 'Purchase Request berhasil disetujui');
    }


    public function print($id)
    {
        $datas = PurchaseRequest::where('id', $id)->with('item')->first();
        $departemen = $datas->departemen;
        $kode = $departemen == 'BARANG' ? 'PURB' : 'PURK';
        $jabatans = [
            'barang' => 'STAFF PURCHASING',
            'lainnya' => 'KA. GUDANG BAHAN BAKU',
            'kemasan' => 'KA. PACKING & GUDANG FG',
            'jasa' => 'FSTL',
        ];
        $jabatan = $jabatans[strtolower($departemen)];
        $data = [
            'title' => 'PURCHASE REQUEST ' . $departemen,
            'dok' => "Dok.No.: FRM.$kode.01.01, Rev.00",
            'datas' => $datas,
            'jabatan' => $jabatan,
            'kategori' => $departemen,
        ];
        return view('pur.pembelian.purchase_request.print', $data);
    }

    public function print_sbw(Request $r)
    {
        $no_pr = $r->no_pr;
        $tgl = $r->tgl;
        $rwb_id = $r->rwb_id;

        $datas = DB::table('sbw_kotor')
            ->where([
                ['tgl', '=', $tgl],
                ['rwb_id', '=', $rwb_id]
            ])
            ->groupBy('tgl', 'rwb_id')
            ->selectRaw("tgl, rwb_id, group_concat(grade_id) as grade_id")
            ->orderBy('tgl', 'ASC')
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
            'title' => 'PURCHASE REQUEST',
            'dok' => 'Dok.No.: FRM.PURS.01.01, Rev.00',
            'kategori' => 'sbw',
            'datas' => $datas,
            'no_pr' => $no_pr,
            'items' => $items,
        ];
        return view('pur.pembelian.purchase_request.print_sbw', $data);
    }

    public function destroy($id, $kategori)
    {
        $sudahPo = PurchaseOrder::where('pr_id', $id)->first();
        if ($sudahPo) {
            return redirect()->route('pur.pembelian.1.index', ['kategori' => $kategori])->with('error', 'Purchase Request sudah memiliki PO');
        }
        PurchaseRequest::where('id', $id)->delete();
        PurchaseRequestItem::where('pr_id', $id)->delete();


        return redirect()->route('pur.pembelian.1.index', ['kategori' => $kategori])->with('sukses', 'Purchase Request berhasil dihapus');
    }
}

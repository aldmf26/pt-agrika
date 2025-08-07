<?php

namespace App\Http\Controllers\PUR\Pembelian;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\DataPegawai;
use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestItem;
use App\Models\User;
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
    }
    public function index()
    {
        $kategori = request()->kategori ?? 'barang';
        $this->singkron();

        if ($kategori == 'barang') {
            $datas = PurchaseRequest::latest()->get();
        } else {
            $datas = collect([]);
        }

        $sbw = DB::table('sbw_kotor')
            ->leftJoin('rumah_walet', 'rumah_walet.id', '=', 'sbw_kotor.rwb_id')
            ->leftJoin('grade_sbw_kotor', 'grade_sbw_kotor.id', '=', 'sbw_kotor.grade_id')
            ->leftJoin('data_edit_wh', 'data_edit_wh.nm_partai', '=', 'sbw_kotor.nm_partai')
            ->select('grade_sbw_kotor.nama', 'rumah_walet.nama as rumah_walet', 'sbw_kotor.*', 'data_edit_wh.driver', 'data_edit_wh.no_kendaraan as no_kendaraan_edit')
            ->orderBy('sbw_kotor.tgl', 'desc')
            ->get();

        $data = [

            'title' => 'PUR 1 Purchase Request',
            'datas' => $datas,
            'sbw' => $sbw,
            'kategori' => $kategori,
        ];

        return view('pur.pembelian.purchase_request.index', $data);
    }

    public function create(Request $r)
    {
        $kategori = $r->kategori ?? 'barang';
        $barangs = Barang::with('supplier')->where('kategori', $kategori)->get();
        $user = DataPegawai::with('divisi')->where('posisi', 'pengawas')->get();
        $data = [
            'title' => 'Tambah Purchase Request',
            'no_pr' => $this->getNoPr(),
            'barangs' => $barangs,
            'kategori' => $kategori,
            'user' => $user,
        ];

        return view('pur.pembelian.purchase_request.create', $data);
    }

    public function getNoPr()
    {
        $bulan = strtoupper(date('n'));
        $tahun = date('Y');
        $lastRequest = PurchaseRequest::latest()->first();

        if ($lastRequest) {
            $lastNo = (int) substr($lastRequest->no_pr, 3, 2);
            $newNo = str_pad($lastNo + 1, 2, '0', STR_PAD_LEFT);
        } else {
            $newNo = '01';
        }

        $romanMonths = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        $bulanRoman = $romanMonths[$bulan - 1];

        $no_pr = "PR/{$newNo}/{$bulanRoman}/{$tahun}";

        return $no_pr;
    }

    public function store(Request $r)
    {
        DB::beginTransaction();
        try {
            $no_pr = $this->getNoPr();
            $tgl = $r->tgl;

            $pr = PurchaseRequest::create([
                'no_pr' => $no_pr,
                'tgl' => $tgl,
                'diminta_oleh' => $r->diminta_oleh,
                'posisi' => $r->posisi,
                'departemen' => $r->departemen,
                'manager_departemen' => $r->manajer_departemen,
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

            return redirect()->route('pur.pembelian.1.index')->with('sukses', 'Purchase Request berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('pur.pembelian.1.create')->with('error', $e->getMessage());
        }
    }



    public function selesai($id)
    {
        PurchaseRequest::where('id', $id)->update(['status' => 'disetujui']);
        return redirect()->route('pur.pembelian.1.index')->with('sukses', 'Purchase Request berhasil disetujui');
    }


    public function print($id)
    {
        $datas = PurchaseRequest::where('id', $id)->with('item')->first();
        $data = [
            'title' => 'PURCHASE REQUEST',
            'dok' => 'Dok.No.: FRM.PUR.01.01, Rev.00',
            'datas' => $datas
        ];
        return view('pur.pembelian.purchase_request.print', $data);
    }
}

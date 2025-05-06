<?php

namespace App\Http\Controllers\PUR\Pembelian;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\PurchaseRequestItem;
use App\Models\Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PUR2PurchaseOrderController extends Controller
{
    public function index()
    {
        $datas = PurchaseOrder::with('item')->latest()->get();
        $data = [
            'title' => 'PUR 2 Purchase Order',
            'datas' => $datas
        ];

        return view('pur.pembelian.purchase_order.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Purchase Order',
            'no_po' => $this->getNoPo(),
            'supplier' => Suplier::latest()->get()
        ];

        return view('pur.pembelian.purchase_order.create', $data);
    }

    public function getNoPo()
    {
        $lastRequest = PurchaseOrder::latest()->first();
        $no_po = $lastRequest ? $lastRequest->no_po + 1 : 1001;
        return $no_po;
    }

    public function selesai(Request $r)
    {
        PurchaseOrder::find($r->id)->update([
            'status' => 'selesai'
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

            return redirect()->route('pur.pembelian.2.index')->with('sukses', 'Purchase Order berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('pur.pembelian.2.create')->with('error', $e->getMessage());
        }
    }

    public function print($id)
    {
        $datas = PurchaseOrder::find($id)->with('item')->first();
        $data = [
            'title' => 'PURCHASE ORDER',
            'dok' => 'Dok.No.: FRM.PUR.01.02, Rev.00',
            'datas' => $datas
        ];
        return view('pur.pembelian.purchase_order.print', $data);
    }
}

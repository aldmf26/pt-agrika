<?php

namespace App\Http\Controllers\PUR\Pembelian;

use App\Http\Controllers\Controller;
use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PUR1PurchaseRequestController extends Controller
{
    public function index()
    {
        $datas = PurchaseRequest::latest()->get();
        $data = [
            'title' => 'PUR 1 Purchase Request',
            'datas' => $datas
        ];

        return view('pur.pembelian.purchase_request.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Purchase Request',
            'no_pr' => $this->getNoPr(),
        ];

        return view('pur.pembelian.purchase_request.create', $data);
    }

    public function getNoPr()
    {
        $lastRequest = PurchaseRequest::latest()->first();
        $no_pr = $lastRequest ? $lastRequest->no_pr + 1 : 1001;
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

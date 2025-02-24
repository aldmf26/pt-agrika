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
        $label = LabelIdentitasBahan::with('barang')->latest()->get();
        $data = [
            'title' => 'Label Identitas Bahan',
            'label' => $label
        ];
        return view('ppc.gudang_rm.label_identitas_bahan.index', $data);
    }
    public function create() 
    {
        $barangs = Barang::whereNotExists(function($query) {
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
        $ids = explode(',', $r->checked);
        $labels = LabelIdentitasBahan::with('barang')->whereIn('id', $ids)->get();
        $data = [
            'labels' => $labels
        ];
        return view('ppc.gudang_rm.label_identitas_bahan.print', $data);
    }
}
